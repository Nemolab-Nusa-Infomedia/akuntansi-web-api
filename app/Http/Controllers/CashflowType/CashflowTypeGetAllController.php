<?php

namespace App\Http\Controllers\CashflowType;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\CashflowType;
use App\Helpers\Response;

class CashflowTypeGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $cashflowTypes = CashflowType::query();

        if ($search) {
            $cashflowTypes->whereAny(
                [
                    'name',
                    'type',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $cashflowTypes = $cashflowTypes->orderBy('name')->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar tipe alur pembayaran', data: $cashflowTypes);
    }
}
