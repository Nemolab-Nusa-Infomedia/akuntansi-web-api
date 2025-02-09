<?php

namespace App\Http\Controllers\Cashflow;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Models\Cashflow;

class CashflowGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $cashflows = Cashflow::query();

        $cashflows = $cashflows->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar alur pembayaran', data: $cashflows);
    }
}
