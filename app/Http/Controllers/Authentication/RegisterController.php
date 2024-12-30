<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\Authentication\RegisterRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\UserCompany;
use App\Helpers\Response;
use App\Models\Company;
use App\Mail\OtpMailer;
use App\Helpers\Token;
use App\Models\User;
use App\Models\Otp;

class RegisterController extends Controller
{
    public function action(RegisterRequest $request): JsonResponse
    {
        [
            'company_name' => $companyName,
            'password' => $password,
            'email' => $email,
            'phone' => $phone,
            'name' => $name,
        ] = $request;

        $response = new Response(Response::CREATED, 'Berhasil melakukan registrasi pengguna, mohon verifikasi kode OTP');

        $user = User::firstWhere(['email' => $email]);

        if ($user === null) {
            DB::beginTransaction();

            try {
                $user = User::create([
                    'status_account' => 'active',
                    'password' => $password,
                    'email' => $email,
                    'phone' => $phone,
                    'name' => $name,
                ]);

                $company = Company::create([
                    'sub_to' => Carbon::now()->setMonth((int) Carbon::now()->format('m') + 1),
                    'sub_from' => Carbon::now(),
                    'name' => $companyName,
                ]);

                UserCompany::create([
                    'company_id' => $company->id,
                    'user_id' => $user->id,
                    'role' => 'admin',
                ]);

                $otp = Otp::create([
                    'code' => Str::random(6),
                    'user_id' => $user->id,
                ]);

                Mail::to($user->email)->send(new OtpMailer($otp->code));

                $token = Token::Generate(['sub' => $otp->id], 3);

                DB::commit();

                $response->set(data: $token);
            } catch (\Exception $e) {
                DB::rollBack();

                $response->set(Response::INTERNAL_SERVER_ERROR, 'Gagal melakukan registrasi', $e);
            }
        } else {
            $response->set(Response::BAD_REQUEST, 'Validasi gagal', [
                [
                    'message' => 'Email tidak valid',
                    'property' => 'email',
                ]
            ]);
        }

        return $response->get();
    }
}
