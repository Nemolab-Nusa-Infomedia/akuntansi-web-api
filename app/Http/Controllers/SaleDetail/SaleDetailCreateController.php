<?php

namespace App\Http\Controllers\SaleDetail;

use App\Http\Requests\SaleDetail\SaleDetailCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\SaleDetail;
use App\Helpers\Response;

class SaleDetailCreateController extends Controller
{
    public function action(SaleDetailCreateRequest $request): JsonResponse
    {
        [
            'qty' => $quantity,
            'total' => $total,

            'product_id' => $productId,
            'sale_id' => $saleId,
        ] = $request;

        DB::beginTransaction();

        try {
            $saleDetail = SaleDetail::create([
                'qty' => $quantity,
                'total' => $total,

                'product_id' => $productId,
                'sale_id' => $saleId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan detail penjualan', data: $saleDetail);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan detail penjualan', $e->getMessage());
        }
    }
}
