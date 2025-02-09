<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\ProductCategory;
use App\Helpers\Response;

class ProductCategoryDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $productCategory = ProductCategory::find($id);

        if ($productCategory) {
            DB::beginTransaction();

            try {
                $productCategory->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus kategori produk');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus kategori produk', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kategori produk tidak dapat ditemukan');
    }
}
