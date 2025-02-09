<?php

namespace App\Http\Controllers\PaymentSubscription;

use App\Http\Controllers\Controller;
use App\Models\PaymentSubscription;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;

class PaymentSubscriptionGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $paymentSubscription = PaymentSubscription::find($id);

        if ($paymentSubscription) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan pembayaran langganan', data: $paymentSubscription);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Pembayaran langganan tidak dapat ditemukan');
    }
}
