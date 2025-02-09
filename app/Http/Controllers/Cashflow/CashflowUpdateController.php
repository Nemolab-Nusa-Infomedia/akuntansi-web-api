<?php

namespace App\Http\Controllers\Cashflow;

use App\Http\Requests\Cashflow\CashflowUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Cashflow;

class CashflowUpdateController extends Controller
{
    public function action(CashflowUpdateRequest $request, string $id): JsonResponse
    {
        $cashflow = Cashflow::find($id);

        if ($cashflow) {
            [
                'transaction_id' => $transactionId,
                'cashflow_type_id' => $typeId,
            ] = $request;

            DB::beginTransaction();

            try {
                $cashflow->update([
                    'transaction_id' => $transactionId,
                    'cashflow_type_id' => $typeId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah alur pembayaran', data: $cashflow);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah alur pembayaran', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Alur pembayaran tidak dapat ditemukan');
    }
}
