<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Sale;

class SaleDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $sale = Sale::find($id);

        if ($sale) {
            DB::beginTransaction();

            try {
                $sale->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus penjualan');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus penjualan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Penjualan tidak dapat ditemukan');
    }
}
