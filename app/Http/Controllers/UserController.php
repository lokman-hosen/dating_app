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

    // user list
    public function index(){
        $data = [
            'pageTitle' => 'User List',
            'tableHeads' => ['Sr. No', 'Image', 'Name', 'Distance(km)', 'Gender', 'Age(in year)', 'Action'],
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

    // user details
    public function show($id){
        $data = [
            'pageTitle' => 'View User',
            'user' => $this->userService->find($id),
        ];
        return view('users.show', $data);
    }

    // update user profile image
    public function changeUserProfileImage(Request $request, $userId){
        $user = $this->userService->updateUserImage($request, $userId);
        if ($user){
            $request->session()->flash('success', setMessage('update', 'User Profile Image'));
            return redirect()->route('user.show',$userId);
        }else{
            $request->session()->flash('error', setMessage('update.error', 'User Profile Image'));
            return redirect()->route('user.list');
        }
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
