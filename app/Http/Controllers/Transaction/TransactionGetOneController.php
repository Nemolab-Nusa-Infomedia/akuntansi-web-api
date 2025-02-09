<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Transaction;
use App\Helpers\Response;

class TransactionGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan transaksi', data: $transaction);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Transaksi tidak dapat ditemukan');
    }
}
