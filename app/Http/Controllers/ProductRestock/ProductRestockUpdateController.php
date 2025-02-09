<?php

namespace App\Http\Controllers\ProductRestock;

use App\Http\Requests\ProductRestock\ProductRestockUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\ProductRestock;
use App\Helpers\Response;

class ProductRestockUpdateController extends Controller
{
    public function action(ProductRestockUpdateRequest $request, string $id): JsonResponse
    {
        $productRestock = ProductRestock::find($id);

        if ($productRestock) {
            [
                'price_buy' => $priceBuy,
                'amount' => $amount,
                'stock' => $stock,

                'product_id' => $productId,
            ] = $request;

            DB::beginTransaction();

            try {
                $productRestock->update([
                    'price_buy' => $priceBuy,
                    'amount' => $amount,
                    'stock' => $stock,

                    'product_id' => $productId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah stok produk', data: $productRestock);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah stok produk', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Stok produk tidak dapat ditemukan');
    }
}
