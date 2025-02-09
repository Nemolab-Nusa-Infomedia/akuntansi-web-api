<?php

namespace App\Http\Controllers\Cashflow;

use App\Http\Requests\Cashflow\CashflowCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Cashflow;

class CashflowCreateController extends Controller
{
    public function action(CashflowCreateRequest $request): JsonResponse
    {
        [
            'transaction_id' => $transactionId,
            'cashflow_type_id' => $typeId,
        ] = $request;

        DB::beginTransaction();

        try {
            $cashflow = Cashflow::create([
                'transaction_id' => $transactionId,
                'cashflow_type_id' => $typeId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan alur pembayaran', data: $cashflow);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan alur pembayaran', $e->getMessage());
        }
    }
}
