<?php

namespace App\Http\Controllers\Cashflow;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Cashflow;

class CashflowDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $cashflow = Cashflow::find($id);

        if ($cashflow) {
            DB::beginTransaction();

            try {
                $cashflow->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus alur pembayaran');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus alur pembayaran', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Alur pembayaran tidak dapat ditemukan');
    }
}
