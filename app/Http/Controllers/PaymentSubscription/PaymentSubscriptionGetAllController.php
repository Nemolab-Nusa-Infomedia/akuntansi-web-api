<?php

namespace App\Http\Controllers\PaymentSubscription;

use App\Http\Controllers\Controller;
use App\Models\PaymentSubscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Response;

class PaymentSubscriptionGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $paymentSubscriptions = PaymentSubscription::query();

        $paymentSubscriptions = $paymentSubscriptions->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar pembayaran langganan', data: $paymentSubscriptions);
    }
}
