<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Helpers\Response;

class TransactionGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $transactions = Transaction::query();

        if ($search) {
            $transactions->whereAny(
                [
                    'description',
                    'date',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $transactions = $transactions->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar transaksi', data: $transactions);
    }
}
