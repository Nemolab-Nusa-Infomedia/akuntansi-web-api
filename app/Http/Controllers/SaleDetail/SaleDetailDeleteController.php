<?php

namespace App\Http\Controllers\SaleDetail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\SaleDetail;
use App\Helpers\Response;

class SaleDetailDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $saleDetail = SaleDetail::find($id);

        if ($saleDetail) {
            DB::beginTransaction();

            try {
                $saleDetail->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus detail penjualan');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus detail penjualan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Detail detail penjualan tidak dapat ditemukan');
    }
}
