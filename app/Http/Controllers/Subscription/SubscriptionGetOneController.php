<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Subscription;
use App\Helpers\Response;

class SubscriptionGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $subscription = Subscription::find($id);

        if ($subscription) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan langganan', data: $subscription);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Langganan tidak dapat ditemukan');
    }
}
