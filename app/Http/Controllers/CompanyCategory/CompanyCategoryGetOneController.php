<?php

namespace App\Http\Controllers\CompanyCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\CompanyCategory;
use App\Helpers\Response;

class CompanyCategoryGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $companyCategory = CompanyCategory::find($id);

        if ($companyCategory) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan kategori perusahaan', data: $companyCategory);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kategori perusahaan tidak dapat ditemukan');
    }
}
