<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Product;

class ProductUpdateController extends Controller
{
    public function action(ProductUpdateRequest $request, string $id): JsonResponse
    {
        $product = Product::find($id);

        if ($product) {
            [
                'description' => $description,
                'price_sell' => $priceSell,
                'image' => $image,
                'stock' => $stock,
                'code' => $code,
                'name' => $name,
                'unit' => $unit,

                'category_id' => $categoryId,
                'company_id' => $companyId,
            ] = $request;

            DB::beginTransaction();

            try {
                $product->update([
                    'description' => $description,
                    'price_sell' => $priceSell,
                    'image' => $image,
                    'stock' => $stock,
                    'code' => $code,
                    'name' => $name,
                    'unit' => $unit,

                    'category_id' => $categoryId,
                    'company_id' => $companyId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah produk', data: $product);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah produk', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Produk tidak dapat ditemukan');
    }
}
