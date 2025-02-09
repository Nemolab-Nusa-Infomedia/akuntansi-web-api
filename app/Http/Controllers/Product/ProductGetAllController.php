<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Models\Product;

class ProductGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $products = Product::query();

        if ($search) {
            $products->whereAny(
                [
                    'description',
                    'code',
                    'name',
                    'unit',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $products = $products->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar produk', data: $products);
    }
}
