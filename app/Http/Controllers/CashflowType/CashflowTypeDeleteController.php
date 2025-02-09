<?php

namespace App\Http\Controllers\CashflowType;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\CashflowType;
use App\Helpers\Response;

class CashflowTypeDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $cashflowType = CashflowType::find($id);

        if ($cashflowType) {
            DB::beginTransaction();

            try {
                $cashflowType->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus tipe alur pembayaran');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus tipe alur pembayaran', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Tipe alur pembayaran tidak dapat ditemukan');
    }
}
