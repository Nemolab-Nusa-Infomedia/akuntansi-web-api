<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Helpers\Response;

class SubscriptionGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $subscriptions = Subscription::query();

        if ($search) {
            $subscriptions->whereAny(
                [
                    'duration_text',
                    'description',
                    'name',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $subscriptions = $subscriptions->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar langganan', data: $subscriptions);
    }
}
