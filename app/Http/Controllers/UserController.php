<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userService;
    protected $redirectUrl;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->redirectUrl = 'user';
        $this->userService = $userService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data = [
            'pageTitle' => 'User List',
            'tableHeads' => ['Id', 'Image', 'Name', 'Distance', 'Gender', 'Age', 'Action'],
            'dataUrl' => $this->redirectUrl.'/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'user_image', 'name' => 'user_image'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'distance', 'name' => 'distance'],
                ['data' => 'gender', 'name' => 'gender'],
                ['data' => 'age', 'name' => 'age'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];

        return view('users.index', $data);
    }

    public function getData(Request $request){
        return $this->userService->getAllData($request);
    }

    // process user(each other) like
    public function userProfileLike($ownerId){
        $likeStatus =  $this->userService->processUserLike($ownerId);
        $mutualLike = $this->userService->checkMutualLikers($ownerId);
        if ($likeStatus){
            // for mutual like
            if ($mutualLike){
                return response()->json(['status' => true, 'mutualFriend' => true]);
            }
            return response()->json(['status' => true]);
        }
    }
}
