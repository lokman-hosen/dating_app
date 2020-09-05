<?php

namespace App\Services;

use App\Like;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Auth;

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
        //dd($query->get());

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';
                if (Auth::id() != $row->id){
                    $actions .= '<a class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill action-button like-button" data-owner-user-id="' . $row->id . '" href="#" title="Like"><i class="flaticon-like"></i></a>';
                }
                $actions.= '<a class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill action-button"  href="" title="Dislike"><i class="flaticon-circle"></i></a>';
                return $actions;
            })
            ->addColumn('age', function ($row) {
                return '30Years';
            })
            ->editColumn('user_image', function ($row) {
                return '<img src="'. url('storage/user_image/'.$row->user_image).'" width="100"/>';
            })
            ->editColumn('gender', function ($row) {
                return setGender($row->status);
            })

            ->addColumn('distance', function ($row) {
                return '3km';
            })

            ->rawColumns(['status', 'user_image', 'gender', 'action'])

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

}
