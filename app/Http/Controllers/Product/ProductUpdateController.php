<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\ProductUpdateRequest;
use Illuminate\Support\Facades\Storage;
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
                'stock' => $stock,
                'code' => $code,
                'name' => $name,
                'unit' => $unit,

                'category_id' => $categoryId,
                'company_id' => $companyId,
            ] = $request;

            $image = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image')->store("/products/$code");
                $image = Storage::url($image);
            }

            DB::beginTransaction();

            try {
                $tempImage = $product->image;

                $product->update([
                    'image' => $image ?? $tempImage,
                    'description' => $description,
                    'price_sell' => $priceSell,
                    'stock' => $stock,
                    'code' => $code,
                    'name' => $name,
                    'unit' => $unit,

                    'category_id' => $categoryId,
                    'company_id' => $companyId,
                ]);

                if ($image) {
                    $tempImage = str_replace(url('storage') . '/', '', $tempImage);
                    if (Storage::has($tempImage)) {
                        Storage::delete($tempImage);
                    }
                }

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah produk', data: $product);
            } catch (\Exception $e) {
                if ($image) {
                    $image = str_replace(url('storage') . '/', '', $image);
                    if (Storage::has($image)) {
                        Storage::delete($image);
                    }
                }

                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah produk', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Produk tidak dapat ditemukan');
    }
}
