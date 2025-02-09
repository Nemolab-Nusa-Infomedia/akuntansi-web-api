<?php

namespace App\Http\Controllers\CashflowType;

use App\Http\Requests\CashflowType\CashflowTypeCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\CashflowType;
use App\Helpers\Response;

class CashflowTypeCreateController extends Controller
{
    public function action(CashflowTypeCreateRequest $request): JsonResponse
    {
        [
            'name' => $name,
            'type' => $type,
        ] = $request;

        DB::beginTransaction();

        try {
            $cashflowType = CashflowType::create([
                'name' => $name,
                'type' => $type,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan tipe alur pembayaran', data: $cashflowType);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan tipe alur pembayaran', $e->getMessage());
        }
    }
}
