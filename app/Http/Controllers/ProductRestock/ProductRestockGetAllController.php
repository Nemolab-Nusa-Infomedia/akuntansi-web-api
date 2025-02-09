<?php

namespace App\Http\Controllers\ProductRestock;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\ProductRestock;
use Illuminate\Http\Request;
use App\Helpers\Response;

class ProductRestockGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $productRestocks = ProductRestock::query();

        $productRestocks = $productRestocks->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar stok produk', data: $productRestocks);
    }
}
