<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Requests\ProductCategory\ProductCategoryUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\ProductCategory;
use App\Helpers\Response;

class ProductCategoryUpdateController extends Controller
{
    public function action(ProductCategoryUpdateRequest $request, string $id): JsonResponse
    {
        $productCategory = ProductCategory::find($id);

        if ($productCategory) {
            [
                'name' => $name,

                'company_id' => $companyId,
            ] = $request;

            DB::beginTransaction();

            try {
                $productCategory->update([
                    'name' => $name,

                    'company_id' => $companyId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah kategori produk', data: $productCategory);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah kategori produk', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kategori produk tidak dapat ditemukan');
    }
}
