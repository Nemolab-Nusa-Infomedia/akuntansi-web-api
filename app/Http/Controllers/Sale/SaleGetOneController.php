<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Sale;

class SaleGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $sale = Sale::find($id);

        if ($sale) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan penjualan', data: $sale);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Penjualan tidak dapat ditemukan');
    }
}
