<?php

namespace App\Http\Controllers\SaleDetail;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\SaleDetail;
use App\Helpers\Response;

class SaleDetailGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $saleDetail = SaleDetail::find($id);

        if ($saleDetail) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan detail penjualan', data: $saleDetail);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Detail detail penjualan tidak dapat ditemukan');
    }
}
