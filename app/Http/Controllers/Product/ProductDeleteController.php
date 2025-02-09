<?php

namespace App\Http\Controllers\Product;

use Illuminate\Support\Facades\Storage;
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
                $image = $product->image;

                $product->delete();

                $image = str_replace(url('storage') . '/', '', $image);
                if (Storage::has($image)) {
                    Storage::delete($image);
                }

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
