<?php

namespace App\Http\Controllers\CompanyCategory;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\CompanyCategory;
use App\Helpers\Response;

class CompanyCategoryDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $companyCategory = CompanyCategory::find($id);

        if ($companyCategory) {
            DB::beginTransaction();

            try {
                $companyCategory->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus kategori perusahaan');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus kategori perusahaan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kategori perusahaan tidak dapat ditemukan');
    }
}
