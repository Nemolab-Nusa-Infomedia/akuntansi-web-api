<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Requests\ProductCategory\ProductCategoryCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\ProductCategory;
use App\Helpers\Response;

class ProductCategoryCreateController extends Controller
{
    public function action(ProductCategoryCreateRequest $request): JsonResponse
    {
        [
            'name' => $name,

            'company_id' => $companyId,
        ] = $request;

        DB::beginTransaction();

        try {
            $productCategory = ProductCategory::create([
                'name' => $name,

                'company_id' => $companyId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan kategori produk', data: $productCategory);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan kategori produk', $e->getMessage());
        }
    }
}
