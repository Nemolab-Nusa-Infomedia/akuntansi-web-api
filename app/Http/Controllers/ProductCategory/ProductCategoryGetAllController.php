<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Helpers\Response;

class ProductCategoryGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $productCategories = ProductCategory::query();

        if ($search) {
            $productCategories->whereAny(
                [
                    'name'
                ],
                'LIKE',
                "%$search%"
            );
        }

        $productCategories = $productCategories->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar kategori produk', data: $productCategories);
    }
}
