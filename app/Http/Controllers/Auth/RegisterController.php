<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $userModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('guest');
        $this->userModel = $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        //dd($request->all());
        //upload course image
        if ($request->hasFile('user_image')){
            $userImageFile = $request->file('user_image');
            //make unique name for image
            $currentDate = now()->toDateString();
            $userImageName= $currentDate.'_'.uniqid().'.'.$userImageFile->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('user_image')) {
                Storage::disk('public')->makeDirectory('user_image');
            }
            //image and upload
            Storage::disk('public')->put('user_image/'.$userImageName, $userImageFile);
        }else{
            $userImageName = 'default.png';
        }
        $user = $this->userModel->create([
            'name' => $request->name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'gender' => 1,
            'location_latitude' => $request->location_latitude,
            'location_longitude' => $request->location_longitude,
            'password' => Hash::make($request->password),
            'user_image' => $userImageName,
        ]);

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }
}
