<?php

namespace App\Http\Controllers\ProductRestock;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\ProductRestock;
use App\Helpers\Response;

class ProductRestockDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $productRestock = ProductRestock::find($id);

        if ($productRestock) {
            DB::beginTransaction();

            try {
                $productRestock->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus stok produk');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus stok produk', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Stok produk tidak dapat ditemukan');
    }
}
