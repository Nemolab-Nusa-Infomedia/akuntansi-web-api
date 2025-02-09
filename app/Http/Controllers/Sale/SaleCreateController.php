<?php

namespace App\Http\Controllers\Sale;

use App\Http\Requests\Sale\SaleCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Sale;

class SaleCreateController extends Controller
{
    public function action(SaleCreateRequest $request): JsonResponse
    {
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
            $sale = Sale::create([
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

            return Response::SetAndGet(message: 'Berhasil menambahkan penjualan', data: $sale);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan penjualan', $e->getMessage());
        }
    }
}
