<?php

namespace App\Http\Controllers\Sale;

use App\Http\Requests\Sale\SaleUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Sale;

class SaleUpdateController extends Controller
{
    public function action(SaleUpdateRequest $request, string $id): JsonResponse
    {
        $sale = Sale::find($id);

        if ($sale) {
            [
                'transaction_date' => $transactionDate,
                'no_transaction' => $transactionNumber,
                'payment_team' => $paymentTeam,
                'attachment' => $attachment,
                'subtotal' => $subTotal,
                'due_date' => $dueDate,
                'total' => $total,
                'memo' => $memo,

                'transaction_id' => $transactionId,
                'contact_id' => $contactId,
            ] = $request;

            DB::beginTransaction();

            try {
                $sale->update([
                    'transaction_date' => $transactionDate,
                    'no_transaction' => $transactionNumber,
                    'payment_team' => $paymentTeam,
                    'attachment' => $attachment,
                    'subtotal' => $subTotal,
                    'due_date' => $dueDate,
                    'total' => $total,
                    'memo' => $memo,

                    'transaction_id' => $transactionId,
                    'contact_id' => $contactId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah penjualan', data: $sale);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah penjualan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Penjualan tidak dapat ditemukan');
    }
}
