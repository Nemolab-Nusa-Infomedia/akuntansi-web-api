<?php

namespace App\Http\Controllers\CashflowType;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\CashflowType;
use App\Helpers\Response;

class CashflowTypeGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $cashflowType = CashflowType::find($id);

        if ($cashflowType) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan tipe alur pembayaran', data: $cashflowType);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Tipe alur pembayaran tidak dapat ditemukan');
    }
}
