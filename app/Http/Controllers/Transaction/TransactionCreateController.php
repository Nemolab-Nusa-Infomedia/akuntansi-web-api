<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Requests\Transaction\TransactionCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Transaction;
use App\Helpers\Response;

class TransactionCreateController extends Controller
{
    public function action(TransactionCreateRequest $request): JsonResponse
    {
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
            $transaction = Transaction::create([
                'description' => $description,
                'amount' => $amount,
                'date' => $date,

                'transaction_category_id' => $categoryId,
                'company_id' => $companyId,
                'user_id' => $userId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan transaksi', data: $transaction);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan transaksi', $e->getMessage());
        }
    }
}
