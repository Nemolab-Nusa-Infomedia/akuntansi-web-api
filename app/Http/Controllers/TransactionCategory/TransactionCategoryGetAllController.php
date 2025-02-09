<?php

namespace App\Http\Controllers\TransactionCategory;

use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Response;

class TransactionCategoryGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $transactionCategorys = TransactionCategory::query();

        if ($search) {
            $transactionCategorys->whereAny(
                [
                    'name',
                    'type',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $transactionCategorys = $transactionCategorys->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar kategori transaksi', data: $transactionCategorys);
    }
}
