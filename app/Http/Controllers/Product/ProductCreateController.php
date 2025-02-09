<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Product;

class ProductCreateController extends Controller
{
    public function action(ProductCreateRequest $request): JsonResponse
    {
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
            $product = Product::create([
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

            return Response::SetAndGet(message: 'Berhasil menambahkan produk', data: $product);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan produk', $e->getMessage());
        }
    }
}
