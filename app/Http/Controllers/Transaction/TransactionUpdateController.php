<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Requests\Transaction\TransactionUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Transaction;
use App\Helpers\Response;

class TransactionUpdateController extends Controller
{
    public function action(TransactionUpdateRequest $request, string $id): JsonResponse
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            [
                'description' => $description,
                'amount' => $amount,
                'date' => $date,

                'transaction_category_id' => $categoryId,
                'company_id' => $companyId,
                'user_id' => $userId,
            ] = $request;

            DB::beginTransaction();

            try {
                $transaction->update([
                    'description' => $description,
                    'amount' => $amount,
                    'date' => $date,

                    'transaction_category_id' => $categoryId,
                    'company_id' => $companyId,
                    'user_id' => $userId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah transaksi', data: $transaction);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah transaksi', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Transaksi tidak dapat ditemukan');
    }
}
