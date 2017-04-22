<?php


declare(strict_types=1);

/*
 * This file is part of Laravel E-Mail Authentication.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\EmailAuth\Http\Controllers;

use Auth;
use BrianFaust\EmailAuth\EmailLogin;
use BrianFaust\EmailAuth\Http\Requests\EmailLoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Routing\Controller;
use Mail;
use Validator;

class MailAuthController extends Controller
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

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(EmailLoginRequest $request)
    {
        $emailLogin = EmailLogin::createForEmail($request->input('email'));

        $url = route(config('email-authenticate.route.as'), [
            'token' => $emailLogin->token,
        ]);

        Mail::send(config('email-authenticate.views.login'), [
            'url' => $url,
        ], function ($m) use ($request) {
            $m->from(
                config('email-authenticate.mail.address'),
                config('email-authenticate.mail.name')
            );

            $m->to($request->input('email'))->subject(
                config('email-authenticate.mail.subject')
            );
        });

        return 'Login email sent. Go check your email.';
    }

    /**
     * Handle a login request to the application.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticateEmail($token)
    {
        $emailLogin = EmailLogin::validFromToken($token);

        Auth::login($emailLogin->user);

        return redirect('home');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user = config('email-authenticate.database.models.user');
        $user = new $user();

        return $user->create([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);
    }
}
