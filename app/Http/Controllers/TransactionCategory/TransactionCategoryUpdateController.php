<?php

namespace App\Http\Controllers\TransactionCategory;

use App\Http\Requests\TransactionCategory\TransactionCategoryUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;

class TransactionCategoryUpdateController extends Controller
{
    public function action(TransactionCategoryUpdateRequest $request, string $id): JsonResponse
    {
        $transactionCategory = TransactionCategory::find($id);

        if ($transactionCategory) {
            [
                'name' => $name,
                'type' => $type,
            ] = $request;

            DB::beginTransaction();

            try {
                $transactionCategory->update([
                    'name' => $name,
                    'type' => $type,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah kategori transaksi', data: $transactionCategory);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah kategori transaksi', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kategori transaksi tidak dapat ditemukan');
    }
}
