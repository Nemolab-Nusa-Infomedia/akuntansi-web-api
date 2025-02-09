<?php

namespace App\Http\Controllers\Cashflow;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Cashflow;

class CashflowGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $cashflow = Cashflow::find($id);

        if ($cashflow) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan alur pembayaran', data: $cashflow);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Alur pembayaran tidak dapat ditemukan');
    }
}
