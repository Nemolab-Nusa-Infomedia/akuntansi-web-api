<?php

namespace App\Http\Controllers\UserCompany;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\UserCompany;
use App\Helpers\Response;

class UserCompanyDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $userCompany = UserCompany::find($id);

        if ($userCompany) {
            DB::beginTransaction();

            try {
                $userCompany->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus pengguna perusahaan');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus pengguna perusahaan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Pengguna perusahaan tidak dapat ditemukan');
    }
}
