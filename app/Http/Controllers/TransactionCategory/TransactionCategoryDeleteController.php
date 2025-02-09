<?php

namespace App\Http\Controllers\TransactionCategory;

use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;

class TransactionCategoryDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $transactionCategory = TransactionCategory::find($id);

        if ($transactionCategory) {
            DB::beginTransaction();

            try {
                $transactionCategory->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus kategori transaksi');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus kategori transaksi', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kategori transaksi tidak dapat ditemukan');
    }
}
