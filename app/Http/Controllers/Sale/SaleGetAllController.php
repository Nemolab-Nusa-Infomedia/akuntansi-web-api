<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Models\Sale;

class SaleGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $sales = Sale::query();

        if ($search) {
            $sales->whereAny(
                [
                    'transaction_date',
                    'no_transaction',
                    'payment_team',
                    'attachment',
                    'due_date',
                    'memo',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $sales = $sales->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar penjualan', data: $sales);
    }
}
