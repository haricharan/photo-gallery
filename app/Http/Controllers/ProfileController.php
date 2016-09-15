<?php

namespace PhotoGallery\Http\Controllers;

use PhotoGallery\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Request;
use Validator;
use PhotoGallery\Models\User;
use PhotoGallery\Repositories\UserRepository;

class ProfileController extends Controller
{

    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->userRepository = $users;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        \Debugbar::info($user->isLinkedToSocialLogin('google'));
        return view('profile')->with('user', $user);
    }

    public function update()
    {
        $user = Auth::user();
        $request = Request::all();
        $validator = Validator::make($request, User::rules(true, $user->id), User::$messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $user->email,
            'password' => $user->password
        ];

        $this->userRepository->update($data, $user->id);
        return redirect()->route('user.profile');
    }
}
