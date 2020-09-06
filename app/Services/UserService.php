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
        $query = $this->model->select();

        $lat = 24.7105776;
        $lng = 88.94138650000001;

        $userIdsAroundFiveKm = DB::select("SELECT *, ( 6371 * acos( cos( radians(" . $lat . ") ) * cos( radians( location_latitude ) ) * cos( radians( location_longitude ) - radians(" . $lng . ") ) + sin( radians(" . $lat . ") ) * sin( radians( location_latitude ) ) ) ) AS distance FROM users HAVING distance <= 5");
        $userIds = [];
        foreach ($userIdsAroundFiveKm as $userId){
            $userIds[] = $userId->id;
        }
        $query = $query->where('id', '!=', Auth::id() )->whereIn('id', $userIds);

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
                return setGender($row->status);
            })

            ->addColumn('distance', function ($row) {
                return '3km';
            })

            ->rawColumns(['user_image', 'gender', 'action'])

            ->make(true);
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
            //image and upload
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
