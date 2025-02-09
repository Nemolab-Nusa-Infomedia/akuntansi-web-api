<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Transaction;
use App\Helpers\Response;

class TransactionDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            DB::beginTransaction();

            try {
                $transaction->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus transaksi');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus transaksi', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Transaksi tidak dapat ditemukan');
    }
}
