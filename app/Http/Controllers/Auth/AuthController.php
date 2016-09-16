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
    // protected $redirectTo = '/';
    protected $userRepository;

    /**
     * Create a new authentication controller instance.
     */
    public function __construct(Guard $auth, UserRepository $users)
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'redirectToSocialProvider', 'handleSocialProviderCallback']]);
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
            return redirect()->route('user.home');
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
        $validator = Validator::make($request, User::rules(false), User::$messages);
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

        return redirect()->route('user.home');
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
        \Debugbar::info('test message');
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
        \Debugbar::info($userCheck);
        $userSocialLogin = $userCheck->socialLogins()->where('provider', '=', $provider)->first();
        \Debugbar::info($userSocialLogin);
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
        \Debugbar::info($userSocialLogin);
        $this->auth->login($userCheck, true);
        return redirect()->route('user.profile');
    }
}
