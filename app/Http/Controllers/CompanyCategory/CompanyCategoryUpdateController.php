<?php

namespace App\Http\Controllers\CompanyCategory;

use App\Http\Requests\CompanyCategory\CompanyCategoryUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\CompanyCategory;
use App\Helpers\Response;

class CompanyCategoryUpdateController extends Controller
{
    public function action(CompanyCategoryUpdateRequest $request, string $id): JsonResponse
    {
        $companyCategory = CompanyCategory::find($id);

        if ($companyCategory) {
            [
                'name' => $name
            ] = $request;

            DB::beginTransaction();

            try {
                $companyCategory->update([
                    'name' => $name
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah kategori perusahaan', data: $companyCategory);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah kategori perusahaan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kategori perusahaan tidak dapat ditemukan');
    }
}
