<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Company;

class CompanyDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $company = Company::find($id);

        if ($company) {
            DB::beginTransaction();

            try {
                $company->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus perusahaan');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus perusahaan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Perusahaan tidak dapat ditemukan');
    }
}
