<?php

namespace App\Http\Controllers\CompanyCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use App\Helpers\Response;

class CompanyCategoryGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $companyCategories = CompanyCategory::query();

        if ($search) {
            $companyCategories->whereAny(
                [
                    'name'
                ],
                'LIKE',
                "%$search%"
            );
        }

        $companyCategories = $companyCategories->orderBy('name')->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar kategori perusahaan', data: $companyCategories);
    }
}
