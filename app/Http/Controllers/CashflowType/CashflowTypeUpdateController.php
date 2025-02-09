<?php

namespace App\Http\Controllers\CashflowType;

use App\Http\Requests\CashflowType\CashflowTypeUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\CashflowType;
use App\Helpers\Response;

class CashflowTypeUpdateController extends Controller
{
    public function action(CashflowTypeUpdateRequest $request, string $id): JsonResponse
    {
        $cashflowType = CashflowType::find($id);

        if ($cashflowType) {
            [
                'name' => $name,
                'type' => $type,
            ] = $request;

            DB::beginTransaction();

            try {
                $cashflowType->update([
                    'name' => $name,
                    'type' => $type,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah tipe alur pembayaran', data: $cashflowType);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah tipe alur pembayaran', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Tipe alur pembayaran tidak dapat ditemukan');
    }
}
