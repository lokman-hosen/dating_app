<?php

namespace App\Services;

use App\Like;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * Class UserService
 * @package App\Services\Admin
 */
class UserService extends BaseService {

    /**
     * @var $model
     */
    protected $model;
    protected $likeModel;
    /**
     * @var string
     */
    protected $url = 'admin/user';


    public function __construct(User $user, Like $like)
    {
        $this->model = $user;
        $this->likeModel = $like;
    }


    /**
     *
     * @return JsonResponse
     */
    public function getAllData($request){
        $query = [];
        //get userIds By login user lat and lan value
        $userIds = $this->getUserIdsAroundFiveKmOfLoginUserLocation();
        if ($userIds){
            $query = $this->model->select();
            $query->whereIn('id', $userIds);
        }

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';
                if (Auth::id() != $row->id){
                    $likedStatus = $this->likeModel->where('owner_id', $row->id)->where('follower_id', Auth::id())->where('like_status', 1)->first();
                    $actionIcon = 'fa-thumbs-up';
                    $title = 'Like';
                    if ($likedStatus){
                        $actionIcon = 'fa-thumbs-down';
                        $title = 'Dislike';
                    }
                    $actions .= '<a class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill action-button like-button" data-owner-user-id="' . $row->id . '" href="#" title="'.$title.'"><i class="far '.$actionIcon.'" style="font-size: 1.7rem;"></i></a>';
                }
                $actions.= '<a href="' . route('user.show', [$row->id]) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View"><i class="flaticon-eye"></i></a>';
                return $actions;
            })

            ->addColumn('age', function ($row) {
                return calculateAgeByBirthDate($row->birth_date);
            })
            ->editColumn('user_image', function ($row) {
                $imagePath = isset($row->user_image) ? $row->user_image : 'default.png';
                return '<img src="'. url('storage/user_image/'.$imagePath).'" width="60"/>';
            })
            ->editColumn('gender', function ($row) {
                return setGender($row->gender);
            })

            ->addColumn('distance', function ($row) {
                $userLat = (float) $row->location_latitude;
                $userLan = (float) $row->location_longitude;
                $loginUserLat = (float) Auth::user()->location_latitude;
                $loginUserLan = (float) Auth::user()->location_longitude;
                $earthRadius = 6371;
                // Calculate distance from login user location to another user(1st way)
                 $distance = vincentyGreatCircleDistance($loginUserLat, $loginUserLan, $userLat, $userLan, $earthRadius);
                 if ($distance > 0){
                     return number_format($distance, 2).' km';
                 }else{
                     return 'Nearby';
                 }
            })

            ->rawColumns(['user_image', 'gender', 'action'])

            ->make(true);
    }

    private function getUserIdsAroundFiveKmOfLoginUserLocation(){
        $loginUser = $this->model->findOrFail(Auth::id());
        $lat = (float) $loginUser->location_latitude;
        $lng = (float) $loginUser->location_longitude;
        $userIdsAroundFiveKm = DB::select("SELECT id, ( 6371 * acos( cos( radians(" . $lat . ") ) * cos( radians( location_latitude ) ) * cos( radians( location_longitude ) - radians(" . $lng . ") ) + sin( radians(" . $lat . ") ) * sin( radians( location_latitude ) ) ) ) AS distance FROM users HAVING distance <= 5 ");
        $userIds = [];
        foreach ($userIdsAroundFiveKm as $userId){
            if ($userId->id != $loginUser->id){
                $userIds[] = $userId->id;
            }
        }
        return $userIds;
    }

    public function processUserLike($ownerId){
        $followerId = Auth::id();
        // check already user liked or disliked profile
        $check = $this->likeModel->where('owner_id', $ownerId)->where('follower_id', $followerId)->first();
        // if have like/dislike info then process existing info or save new like info
        if ($check){
            // if already liked then dislike
            if ($check->like_status == 1){
                $like = $this->likeModel->where('owner_id', $ownerId)
                    ->where('follower_id', $followerId)
                    ->update(['like_status' => 0]);
            }else{
                // if already disliked then like again
                $like = $this->likeModel->where('owner_id', $ownerId)
                    ->where('follower_id', $followerId)
                    ->update(['like_status' => 1]);
            }
        }else{
           $like = $this->likeModel->create([
                'owner_id' => $ownerId,
                'follower_id' => $followerId,
                'like_status' => 1,
            ]);
        }

        return $like;

    }

    //check mutual liker
    public function checkMutualLikers($ownerId){
        $followerId = Auth::id();
        $ownerLikeCheck = $this->likeModel->where('owner_id', $ownerId)
            ->where('follower_id', $followerId)
            ->where('like_status', 1)
            ->count();
        if ($ownerLikeCheck > 0){
            $followerLikeCheck = $this->likeModel->where('follower_id', $ownerId)
                ->where('owner_id', $followerId)
                ->where('like_status', 1)
                ->count();
            if ($followerLikeCheck > 0){
                return true;
            }
        }else{
            return false;
        }
    }

    //change user image
    public function updateUserImage($request, $userId){
        $user = $this->model->findOrFail($userId);

        $slug = Str::slug($user->name);
        if ($request->hasFile('user_image')){
            $userImageFile = $request->file('user_image');
            //make unique name for image
            $currentDate = now()->toDateString();
            $userImageName = $slug.'_'.$currentDate.'_'.uniqid().'.'.$userImageFile->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('user_image')) {
                Storage::disk('public')->makeDirectory('user_image');
            }
            //delete old image
            if (Storage::disk('public')->exists('user_image/'.$user->user_image)){
                Storage::disk('public')->delete('user_image/'.$user->user_image);
            }
            // resize image and upload
            $userImage = Image::make($userImageFile)->resize(400, 350)->stream();
            Storage::disk('public')->put('user_image/'.$userImageName, $userImage);
        }else{
            $userImageName = $user->user_image;
        }
        $this->model->where('id', $userId)->update([
            'user_image' => $userImageName,
        ]);

        return $user;
    }

}
