<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\Authentication\LoginRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Helpers\Response;
use App\Mail\OtpMailer;
use App\Helpers\Token;
use App\Models\User;
use App\Models\Otp;

class LoginController extends Controller
{
    public function action(LoginRequest $request): JsonResponse
    {
        [
            'password' => $password,
            'email' => $email,
        ] = $request;

        $response = new Response(message: 'Login berhasil, mohon verifikasi kode OTP');

        $user = User::firstWhere('email', $email);

        if ($user !== null && Hash::check($password, $user?->password) && $user?->status_account === 'active') {
            DB::beginTransaction();

            try {
                Otp::where('user_id', $user->id)->delete();

                $otp = Otp::create([
                    'code' => Str::random(6),
                    'user_id' => $user->id,
                ]);

                Mail::to($user->email)->send(new OtpMailer($otp->code));

                $token = Token::Generate(['sub' => $otp->id, 'action' => 'login'], 3);

                DB::commit();

                $response->set(data: $token);
            } catch (\Exception $e) {
                DB::rollBack();

                $response->set(Response::INTERNAL_SERVER_ERROR, 'Login gagal', $e);
            }
        } else {
            $response->set(Response::BAD_REQUEST, 'Validasi gagal', [
                [
                    'message' => 'Email atau kata sandi tidak valid',
                    'property' => 'email',
                ],
                [
                    'message' => 'Email atau kata sandi tidak valid',
                    'property' => 'password',
                ]
            ]);
        }

        return $response->get();
    }
}
