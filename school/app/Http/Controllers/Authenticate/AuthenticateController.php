<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authenticate\ChangePasswordRequest;
use App\Http\Requests\Authenticate\LoginRequest;
use App\Http\Requests\Authenticate\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        $user = null;
        if ($validated['login_type'] == 0)
            $user = User::where('model_number', $validated['user_name'])->where('user_type', 'student')->first();
        elseif ($validated['login_type'] == 1)
            $user = User::where('model_number', $validated['user_name'])->where('user_type', 'teacher')->first();
        elseif ($validated['login_type'] == 2) {
            $user = User::where('model_number', $validated['user_name'])->where('user_type', 'student')->first();
            if ($user) {
                if ($user->family_id) {
                    $user = User::findOrFail($user->family_id);
                } else
                    $user = null;
            } else
                $user = null;
        } elseif ($validated['login_type'] == 3)
            $user = User::where('email', $validated['user_name'])->where('user_type', 'admin')->first();
        if ($user) {
            if (Hash::check($validated['password'], $user->password)) {
                if ($user->status == 'active') {
                    return $this->Data([
                        'token' => $user->createToken('api-login')->plainTextToken,
                        'user' => $user->sub_model_resources()
                    ]);
                } else {
                    return $this->Error($user->blocked_reason);
                }
            }
        }
        return $this->ValidationError(["user_name" => ["You have entered an invalid email or password"]]);

    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();
        return $this->Success('You have successfully logged out');
    }

    public function get_auth(): \Illuminate\Http\JsonResponse
    {
        return $this->Data(['user' => Auth::user()->sub_model_resources()]);
    }

    public function change_password(ChangePasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        $user = Auth::user();
        $user->password = Hash::make($validated['password']);
        $user->save();
        return $this->Success('Password has been updated successfully');
    }

    public function update_profile(UpdateProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        $user = Auth::user();
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        $user->avatar_id = $validated['avatar_id'];
        $user->phone = $validated['phone'];
        $user->save();
        return $this->Success('Your profile has been updated Successfully');
    }


}
