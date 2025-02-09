<?php

namespace App\Http\Controllers\PaymentSubscription;

use App\Http\Controllers\Controller;
use App\Models\PaymentSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;

class PaymentSubscriptionDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $paymentSubscription = PaymentSubscription::find($id);

        if ($paymentSubscription) {
            DB::beginTransaction();

            try {
                $paymentSubscription->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus pembayaran langganan');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus pembayaran langganan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Pembayaran langganan tidak dapat ditemukan');
    }
}
