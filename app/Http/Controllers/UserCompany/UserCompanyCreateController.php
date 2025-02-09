<?php

namespace App\Http\Controllers\UserCompany;

use App\Http\Requests\UserCompany\UserCompanyCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\UserCompany;
use App\Helpers\Response;

class UserCompanyCreateController extends Controller
{
    public function action(UserCompanyCreateRequest $request): JsonResponse
    {
        [
            'role' => $role,

            'company_id' => $companyId,
            'user_id' => $userId,
        ] = $request;

        DB::beginTransaction();

        try {
            $userCompany = UserCompany::create([
                'role' => $role,

                'company_id' => $companyId,
                'user_id' => $userId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan pengguna perusahaan', data: $userCompany);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan pengguna perusahaan', $e->getMessage());
        }
    }
}
