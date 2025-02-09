<?php

namespace App\Http\Controllers\PaymentSubscription;

use App\Http\Requests\PaymentSubscription\PaymentSubscriptionCreateRequest;
use App\Http\Controllers\Controller;
use App\Models\PaymentSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;

class PaymentSubscriptionCreateController extends Controller
{
    public function action(PaymentSubscriptionCreateRequest $request): JsonResponse
    {
        [
            'amount' => $amount,

            'subscription_id' => $subscriptionId,
            'company_id' => $companyId,
        ] = $request;

        DB::beginTransaction();

        try {
            $paymentSubscription = PaymentSubscription::create([
                'amount' => $amount,

                'subscription_id' => $subscriptionId,
                'company_id' => $companyId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan pembayaran langganan', data: $paymentSubscription);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan pembayaran langganan', $e->getMessage());
        }
    }
}
