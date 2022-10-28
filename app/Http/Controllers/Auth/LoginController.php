<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\IdentityProvider;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Custom Login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Add email to login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            return redirect()->route('/');
        }

        return redirect('login');
    }

    public function redirectToOAuth()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/calendar'])
            ->with(['access_type' => 'offline'])
            ->redirect();
    }

    public function callbackFromOAuth()
    {
        $provider = 'google';
        $google_user = Socialite::driver($provider)->stateless()->user();

        if (!$google_user) return redirect('login');

        $account = IdentityProvider::where('provider_name', $provider)
            ->where('provider_id', $google_user->getId())
            ->first();

        if ($account->user) {
            User::find($account->user->id)->update([
                'access_token' => $google_user->token,
                'refresh_token' => $google_user->refreshToken,
            ]);
        }

        $user = User::firstOrCreate(
            [
                'email' => $google_user->email
            ],
            [
                'user_id' => Str::snake(Str::before($google_user->email, '@')),
                'name' => $google_user->name,
                'email' => $google_user->email,
                'password' => bcrypt(Str::random(20)),
                'access_token' => $google_user->token,
                'refresh_token' => $google_user->refreshToken,
            ]
        );

        $user->IdentityProviders()->firstOrCreate(
            [
                'provider_id' => $google_user->getId(),
            ],
            [
                'provider_id' => $google_user->getId(),
                'provider_name' => $provider,
            ]
        );

        $user = $account->user ?? $user;

        Auth::login($user, true);

        return redirect('/');
    }
}
