<?php

namespace App\Http\Controllers\ProductRestock;

use App\Http\Requests\ProductRestock\ProductRestockCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\ProductRestock;
use App\Helpers\Response;

class ProductRestockCreateController extends Controller
{
    public function action(ProductRestockCreateRequest $request): JsonResponse
    {
        [
            'price_buy' => $priceBuy,
            'amount' => $amount,
            'stock' => $stock,

            'product_id' => $productId,
        ] = $request;

        DB::beginTransaction();

        try {
            $productRestock = ProductRestock::create([
                'price_buy' => $priceBuy,
                'amount' => $amount,
                'stock' => $stock,

                'product_id' => $productId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan stok produk', data: $productRestock);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan stok produk', $e->getMessage());
        }
    }
}
