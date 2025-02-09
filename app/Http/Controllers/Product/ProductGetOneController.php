<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Product;

class ProductGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $product = Product::find($id);

        if ($product) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan produk', data: $product);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Produk tidak dapat ditemukan');
    }
}
