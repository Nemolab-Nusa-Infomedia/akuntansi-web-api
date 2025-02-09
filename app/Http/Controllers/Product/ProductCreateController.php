<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\ProductCreateRequest;
use Illuminate\Support\Facades\Storage;
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
            'stock' => $stock,
            'code' => $code,
            'name' => $name,
            'unit' => $unit,

            'category_id' => $categoryId,
            'company_id' => $companyId,
        ] = $request;

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store("/products/$code");
            $image = Storage::url($image);
        }

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
            $image = str_replace(url('storage') . '/', '', $image);
            if (Storage::has($image)) {
                Storage::delete($image);
            }

            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan produk', $e->getMessage());
        }
    }
}
