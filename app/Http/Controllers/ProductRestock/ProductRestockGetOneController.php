<?php

namespace App\Http\Controllers\ProductRestock;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\ProductRestock;

class ProductRestockGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $productRestock = ProductRestock::find($id);

        if ($productRestock) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan stok produk', data: $productRestock);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Stok produk tidak dapat ditemukan');
    }
}
