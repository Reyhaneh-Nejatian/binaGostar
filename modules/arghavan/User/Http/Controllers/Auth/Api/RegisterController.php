<?php

namespace arghavan\User\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use arghavan\RolePermissions\Models\Role;
use arghavan\User\Models\User;
use arghavan\User\Rules\validMobile;
use arghavan\User\Rules\validPassword;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

//    use RegistersUsers;

    public function register(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['nullable', 'string', 'min:9', 'max:14', 'unique:users',new validMobile()],
            'password' => ['required', 'string', 'min:6', 'confirmed',new validPassword()],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 422);
        }
        $data['password'] = Hash::make($request->password);
        $user = User::create($data)->assignRole(Role::ROLE_USER);

        $user = auth()->loginUsingId($user->id);

        event(new Registered($user));

        $accessToken = $user->createToken('UserToken')->accessToken;
        return response()->json([
            'user' => $user,
            'message' =>'ثبت نام با موفقیت انجام شد. یک کد 6 رقمی به ایمیلتان ارسال شده.',
            'token' => $accessToken,
            'token_type' => 'Bearer'
        ]);

    }

}
