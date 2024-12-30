<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\Authentication\ForgetPasswordRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Helpers\Response;
use App\Mail\OtpMailer;
use App\Helpers\Token;
use App\Models\User;
use App\Models\Otp;

class ForgetPasswordController extends Controller
{
    public function action(ForgetPasswordRequest $request): JsonResponse
    {
        [
            'email' => $email
        ] = $request;

        $response = new Response(message: 'Lupa kata sandi berhasil, mohon verifikasi kode OTP');

        $user = User::firstWhere('email', $email);

        if ($user !== null && $user?->status_account === 'active') {
            DB::beginTransaction();

            try {
                Otp::where('user_id', $user->id)->delete();

                $otp = Otp::create([
                    'code' => Str::random(6),
                    'user_id' => $user->id,
                ]);

                Mail::to($user->email)->send(new OtpMailer($otp->code));

                $token = Token::Generate(['sub' => $otp->id, 'action' => 'forget-password'], 3);

                DB::commit();

                $response->set(data: $token);
            } catch (\Exception $e) {
                DB::rollBack();

                $response->set(Response::INTERNAL_SERVER_ERROR, 'Lupa kata sandi gagal', $e);
            }
        } else {
            $response->set(Response::BAD_REQUEST, 'Validasi gagal', [
                [
                    'message' => 'Email tidak valid',
                    'property' => 'email',
                ],
            ]);
        }

        return $response->get();
    }
}
