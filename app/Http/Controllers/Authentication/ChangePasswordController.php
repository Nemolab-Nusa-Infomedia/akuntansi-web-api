<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\Authentication\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Otp;

class ChangePasswordController extends Controller
{
    public function action(ChangePasswordRequest $request): JsonResponse
    {
        $response = new Response(message: 'Berhasil merubah kata sandi');

        $payload = $request->attributes->get('jwt_payload');

        if (isset($payload['sub'], $payload['action'])) {
            [
                'password' => $password,
            ] = $request;

            $otp = Otp::find($payload['sub']);

            if ($otp?->user) {
                if ($payload['action'] === 'change-password') {
                    $otp->user->update(['password' => $password]);
                    $otp->delete();
                } else {
                    $response->set(Response::UNAUTHORIZED, 'Anda tidak memiliki akses');
                }
            } else {
                $response->set(Response::UNAUTHORIZED, 'Anda tidak memiliki akses');
            }
        } else {
            $response->set(Response::UNAUTHORIZED, 'Anda tidak memiliki akses');
        }

        return $response->get();
    }
}
