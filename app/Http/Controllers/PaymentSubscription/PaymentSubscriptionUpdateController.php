<?php

namespace App\Http\Controllers\PaymentSubscription;

use App\Http\Requests\PaymentSubscription\PaymentSubscriptionUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\PaymentSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;

class PaymentSubscriptionUpdateController extends Controller
{
    public function action(PaymentSubscriptionUpdateRequest $request, string $id): JsonResponse
    {
        $paymentSubscription = PaymentSubscription::find($id);

        if ($paymentSubscription) {
            [
                'amount' => $amount,

                'subscription_id' => $subscriptionId,
                'company_id' => $companyId,
            ] = $request;

            DB::beginTransaction();

            try {
                $paymentSubscription->update([
                    'amount' => $amount,

                    'subscription_id' => $subscriptionId,
                    'company_id' => $companyId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah pembayaran langganan', data: $paymentSubscription);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah pembayaran langganan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Pembayaran langganan tidak dapat ditemukan');
    }
}
