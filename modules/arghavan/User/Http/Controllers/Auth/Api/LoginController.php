<?php

namespace arghavan\User\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use arghavan\User\Models\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Token\Parser;

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

    use AuthenticatesUsers;

//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    protected function credentials(Request $request)
    {
        $username = $request->get($this->username());

        $field = filter_var($username,FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        return [
            $field => $username,
            'password' => $request->password,
        ];
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->boolean('remember')
        );
    }

    public function showLoginForm()
    {
        return response()->json('نمایش ویو لاگین');
    }

    public function login(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 422);
        }
        if (!auth()->attempt($data)) {
            return response()->json('ایمیل یا رمز عبور اشتباه است.', 422);
        }


        $username = $request->get($this->username());

        $field = filter_var($username,FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        $user = User::where($field, $request->email)->first();

        $tokenResult = $user->createToken('UserToken');
        $tokenModel = $tokenResult->token;
        if ($request->remember_me)
            $tokenModel->expires_at = Carbon::now()->addWeeks(1);
        $tokenModel->save();

        $api_token = Crypt::encryptString($tokenResult->accessToken);

        setcookie("token", $api_token, time() + 3600, '/');

        if(auth()->check())
        {
            $user = User::query()->findOrFail(auth()->id());
            if($user->email_verified_at == null)
            {
                event(new Registered($user));
                return response()->json([
                    'user' => $user,
                    'message' => 'یک کد 6 رقمی به ایمیلتان ارسال شده.',
                    'token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer'
                ]);
            }
        }

        return response()->json([
            'user' => $user,
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer'
        ]);





//        $request->validate([
//            'email' => ['required', 'max:255'],
//            'password' => ['required'],
//        ]);
//
//        if(!$this->attemptLogin($request)){
//            return response()->json([
//                'status' => false,
//                'message' => 'Username & Password does not match with our record.',
//            ], 401);
//        }

//        $username = $request->get($this->username());
//
//        $field = filter_var($username,FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
//
//        $user = User::where($field, $request->email)->first();

//        $token = $user->api_token;
//
//        $api_token = Crypt::encryptString($token);
//
//        setcookie("token", $api_token, time() + 3600, '/');

//        if(auth()->check())
//        {
//            $user = User::query()->findOrFail(auth()->id());
//            if($user->email_verified_at == null)
//            {
//                event(new Registered($user));
//            }
//        }
//
//        return response()->json([
//            'user' => $user,
//            'status' => true,
//            'message' => 'User Logged In Successfully',
//        ], 200);


    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json('شما با موفقیت خارج شدید.');
    }

}
