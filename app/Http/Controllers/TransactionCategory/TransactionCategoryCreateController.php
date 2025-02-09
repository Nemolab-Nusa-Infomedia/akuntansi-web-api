<?php

namespace App\Http\Controllers\TransactionCategory;

use App\Http\Requests\TransactionCategory\TransactionCategoryCreateRequest;
use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;

class TransactionCategoryCreateController extends Controller
{
    public function action(TransactionCategoryCreateRequest $request): JsonResponse
    {
        [
            'name' => $name,
            'type' => $type,
        ] = $request;

        DB::beginTransaction();

        try {
            $transactionCategory = TransactionCategory::create([
                'name' => $name,
                'type' => $type,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan kategori transaksi', data: $transactionCategory);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan kategori transaksi', $e->getMessage());
        }
    }
}
