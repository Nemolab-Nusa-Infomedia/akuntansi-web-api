<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Requests\Subscription\SubscriptionCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Subscription;
use App\Helpers\Response;

class SubscriptionCreateController extends Controller
{
    public function action(SubscriptionCreateRequest $request): JsonResponse
    {
        [
            'duration_text' => $durationText,
            'description' => $description,
            'duration' => $duration,
            'price' => $price,
            'name' => $name,
        ] = $request;

        DB::beginTransaction();

        try {
            $role = Subscription::create([
                'duration_text' => $durationText,
                'description' => $description,
                'duration' => $duration,
                'price' => $price,
                'name' => $name,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan langganan', data: $role);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan langganan', $e->getMessage());
        }
    }
}
