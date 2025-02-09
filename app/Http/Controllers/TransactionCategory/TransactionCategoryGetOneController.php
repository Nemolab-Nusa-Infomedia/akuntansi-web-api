<?php

namespace App\Http\Controllers\TransactionCategory;

use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;

class TransactionCategoryGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $transactionCategory = TransactionCategory::find($id);

        if ($transactionCategory) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan kategori transaksi', data: $transactionCategory);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kategori transaksi tidak dapat ditemukan');
    }
}
