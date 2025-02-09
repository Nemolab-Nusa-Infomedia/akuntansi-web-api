<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Product;

class ProductDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $product = Product::find($id);

        if ($product) {
            DB::beginTransaction();

            try {
                $product->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus produk');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus produk', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Produk tidak dapat ditemukan');
    }
}
