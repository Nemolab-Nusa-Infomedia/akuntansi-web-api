<?php

namespace App\Http\Controllers\UserCompany;

use App\Http\Requests\UserCompany\UserCompanyUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\UserCompany;
use App\Helpers\Response;

class UserCompanyUpdateController extends Controller
{
    public function action(UserCompanyUpdateRequest $request, string $id): JsonResponse
    {
        $userCompany = UserCompany::find($id);

        if ($userCompany) {
            [
                'role' => $role,

                'company_id' => $companyId,
                'user_id' => $userId,
            ] = $request;

            DB::beginTransaction();

            try {
                $userCompany->update([
                    'role' => $role,

                    'company_id' => $companyId,
                    'user_id' => $userId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah pengguna perusahaan', data: $userCompany);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah pengguna perusahaan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Pengguna perusahaan tidak dapat ditemukan');
    }
}
