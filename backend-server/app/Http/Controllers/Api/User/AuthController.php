<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\OtpVerifyRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\AuthResource;
use App\Http\Resources\User\WishlistResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {


        $user = User::verifiedUser()->where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this->makeToken($user);
    }


    // public function register(RegisterRequest $request)
    // {
    //     try {
    //         $user = User::create($request->validated());
    //         $data = twilio_env();
    //         $res = $data->verifications->create("+88" . $user->phone, "sms");
    //         return send_ms('Otp Send Success', $res->status, 200);
    //     } catch (\Exception $e) {
    //         return send_ms($e->getMessage(), false, $e->getCode());
    //     }
    // }


    // public function otpResend(Request $request)
    // {
    //     try {
    //         $user = User::where('phone', $request->phone)->first();
    //         $data = twilio_env();
    //         $res = $data->verifications->create("+88" . $user->phone, "sms");
    //         return send_ms('Otp Send Success', $res->status, 200);
    //     } catch (\Exception $e) {
    //         return send_ms($e->getMessage(), false, $e->getCode());
    //     }
    // }

    // public function verifyOtp(OtpVerifyRequest $request)
    // {
    //     try {
    //         $data = twilio_env();
    //         $res =   $data->verificationChecks->create(
    //             [
    //                 "to" => "+88" . $request->phone,
    //                 "code" => $request->otp_code
    //             ]
    //         );

    //         if ($res->status === 'approved') {
    //             $user = User::where('phone', $request->phone)->first();
    //             $user->update(['isVerified' => 1]);
    //             return $this->makeToken($user);
    //         } else {
    //             throw ValidationException::withMessages([
    //                 'otp_code' => ['The provided Otp Code are incorrect.'],
    //             ]);
    //         }
    //     } catch (\Exception $e) {
    //         return send_ms($e->getMessage(), false, $e->getCode());
    //     }

    //     // return send_ms('Otp Send Success', $res->status, 200);
    // }

    public function makeToken($user)
    {
        $wishlists = $user->userWishlistProducts()->get();
        $token =  $user->createToken('user-token')->plainTextToken;
        return (new AuthResource($user))
            ->additional(['meta' => [
                'token' => $token,
                'token_type' => 'Bearer',
                'wishlists' => $wishlists,
            ]]);
    }


    public function logout(Request $request)
    {

        try {
            $request->user()->tokens()->delete();
            return send_ms('User Logoout', true, 200);
        } catch (\Exception $e) {
            return send_ms($e->getMessage(), false, $e->getCode());
        }
    }

    public function user(Request $request)
    {
        return AuthResource::make($request->user());
    }


    public function addressStore(Request $request)
    {
        $request->user()->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'address' => $request->address,
        ]);

        return send_ms('Address Saved', true, 201);
    }


    // public function address(Request $request)
    // {
    //     $id = Auth::guard('user-api')->id();

    //     $data = User::where('id', $id)->select('division_id', 'district_id', 'address')->with([
    //         'division' => function ($query) {
    //             $query->select('id', 'name', 'charge');
    //         },
    //         'district' => function ($query) {
    //             $query->select('id', 'name');
    //         }
    //     ])->first();


    //     return WishlistResource::make($data);
    // }
}
