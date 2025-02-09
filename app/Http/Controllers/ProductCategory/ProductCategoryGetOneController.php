<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\ProductCategory;
use App\Helpers\Response;

class ProductCategoryGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $productCategory = ProductCategory::find($id);

        if ($productCategory) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan kategori produk', data: $productCategory);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kategori produk tidak dapat ditemukan');
    }
}
