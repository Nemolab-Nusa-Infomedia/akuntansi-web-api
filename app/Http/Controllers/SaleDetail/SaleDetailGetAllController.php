<?php

namespace App\Http\Controllers\SaleDetail;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\SaleDetail;
use App\Helpers\Response;

class SaleDetailGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $saleDetails = SaleDetail::query();

        $saleDetails = $saleDetails->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar detail penjualan', data: $saleDetails);
    }
}
