<?php

namespace App\Http\Controllers\SaleDetail;

use App\Http\Requests\SaleDetail\SaleDetailUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\SaleDetail;
use App\Helpers\Response;

class SaleDetailUpdateController extends Controller
{
    public function action(SaleDetailUpdateRequest $request, string $id): JsonResponse
    {
        $saleDetail = SaleDetail::find($id);

        if ($saleDetail) {
            [
                'qty' => $quantity,
                'total' => $total,

                'product_id' => $productId,
                'sale_id' => $saleId,
            ] = $request;

            DB::beginTransaction();

            try {
                $saleDetail->update([
                    'qty' => $quantity,
                    'total' => $total,

                    'product_id' => $productId,
                    'sale_id' => $saleId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah detail penjualan', data: $saleDetail);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah detail penjualan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Detail detail penjualan tidak dapat ditemukan');
    }
}
