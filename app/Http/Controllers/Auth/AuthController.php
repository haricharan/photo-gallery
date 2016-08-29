<?php

namespace PhotoGallery\Http\Controllers\Auth;

use PhotoGallery\Models\User;
use PhotoGallery\Repositories\UserRepository;
use PhotoGallery\Models\SocialLogin;
use Validator;
use Request;
use Illuminate\Contracts\Auth\Guard;
use PhotoGallery\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $userRepository;

    /**
     * Create a new authentication controller instance.
     */
    public function __construct(Guard $auth, UserRepository $users)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->userRepository = $users;
        $this->auth = $auth;
    }

    public function login()
    {
        $email = Request::get('email');
        $password = Request::get('password');
        $remember = Request::get('remember');
        if ($this->auth->attempt([
            'email' => $email,
            'password' => $password,
        ], $remember == 1 ? true : false)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()
                ->with('message', 'Incorrect email or password')
                ->with('status', 'danger')
                ->withInput();
        }
    }

    public function register()
    {
        $request = Request::all();
        $validator = Validator::make($request, User::$rules, User::$messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        $this->userRepository->register($data);
        $this->auth->attempt([
                    'email' => $request['email'],
                    'password' => $request['password'],
                ], true);

        return redirect()->route('home');
    }

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('auth.login');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param string $provider
     *
     * @return Response
     */
    public function redirectToSocialProvider($provider)
    {
        $providerKey = \Config::get('services.'.$provider);
        // if (empty($providerKey)) {
        //     return view('pages.status')
        //         ->with('error', 'No such provider');
        // }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleSocialProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        \Debugbar::info($user);
        $userCheck = User::where('email', '=', $user->email)->first();
        if (empty($userCheck)) {
            $newUserData = [
                'first_name' => explode(' ', $user->name)[0],
                'last_name' => explode(' ', $user->name)[1],
                'email' => $user->email,
                'password' => str_random(15),
            ];

            $this->userRepository->register($newUserData);
            $userCheck = User::where('email', '=', $user->email)->first();
        }
        
        $userSocialLogin = $userCheck->socialLogins()->where('provider', '=', $provider)->first();
        if (empty($userSocialLogin)) {
            $userSocialLogin = SocialLogin::create([
                'user_id' => $userCheck->id,
                'social_id' => $user->getId(),
                'provider' => $provider,
                'token' => $user->token,
                'nickname' => $user->getNickname(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar()
            ]);
            $userSocialLogin = $userCheck->socialLogins()->where('provider', '=', $provider)->first();
        }
        $this->auth->login($userCheck, true);
        return redirect()->route('home');
    }

/*    public function socialHandle($provider)
    {
        $user = Socialite::driver($provider)->user();
        $socialUser = null;
        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();
        if (!empty($userCheck)) {
            $socialUser = $userCheck;
        } else {
            $sameSocialId = Social::where('social_id', '=', $user->id)->where('provider', '=', $provider)->first();
            if (empty($sameSocialId)) {
                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new User;
                $newSocialUser->email              = $user->email;
                $name = explode(' ', $user->name);
                $newSocialUser->first_name         = $name[0];
                $newSocialUser->last_name          = $name[1];
                $newSocialUser->save();
                $socialData = new Social;
                $socialData->social_id = $user->id;
                $socialData->provider= $provider;
                $newSocialUser->social()->save($socialData);
                // Add role
                $role = Role::whereName('user')->first();
                $newSocialUser->assignRole($role);
                $socialUser = $newSocialUser;
            } else {
                //Load this existing social user
                $socialUser = $sameSocialId->user;
            }
        }
        $this->auth->login($socialUser, true);
        if ($this->auth->user()->hasRole('user')) {
            return redirect()->route('user.home');
        }
        if ($this->auth->user()->hasRole('administrator')) {
            return redirect()->route('admin.home');
        }
        return \App::abort(500);
    }*/
}
