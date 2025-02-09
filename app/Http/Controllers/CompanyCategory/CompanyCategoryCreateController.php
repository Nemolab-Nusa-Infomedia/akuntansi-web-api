<?php

namespace App\Http\Controllers\CompanyCategory;

use App\Http\Requests\CompanyCategory\CompanyCategoryCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\CompanyCategory;
use App\Helpers\Response;

class CompanyCategoryCreateController extends Controller
{
    public function action(CompanyCategoryCreateRequest $request): JsonResponse
    {
        [
            'name' => $name
        ] = $request;

        DB::beginTransaction();

        try {
            $companyCategory = CompanyCategory::create([
                'name' => $name,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan kategori perusahaan', data: $companyCategory);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan kategori perusahaan', $e->getMessage());
        }
    }
}
