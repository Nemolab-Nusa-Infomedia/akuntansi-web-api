<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\Authentication\OtpVerificationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Helpers\Token;
use App\Models\Otp;

class OtpVerificationController extends Controller
{
    public function action(OtpVerificationRequest $request): JsonResponse
    {
        $response = new Response(message: 'Berhasil melakukan verifikasi kode OTP');

        $payload = $request->attributes->get('jwt_payload');

        if (isset($payload['sub'], $payload['action'])) {
            [
                'otp' => $otpCode,
            ] = $request;

            $otp = Otp::find($payload['sub']);

            if ($otp?->code === $otpCode) {
                if (in_array($payload['action'], ['register', 'login'])) {
                    $token = Token::Generate(['sub' => $otp->user_id], accessToken: true);

                    $otp->delete();

                    $response->set(data: [
                        'access_token' => $token->get('token'),
                        'exp' => $token->get('exp'),
                    ]);
                }
            } else {
                $response->set(Response::BAD_REQUEST, 'Validasi gagal', [
                    [
                        'message' => 'Kode OTP tidak valid',
                        'property' => 'otp',
                    ]
                ]);
            }
        } else {
            $response->set(Response::UNAUTHORIZED, 'Anda tidak memiliki akses');
        }

        return $response->get();
    }
}
