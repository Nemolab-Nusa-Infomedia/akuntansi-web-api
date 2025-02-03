<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Requests\Subscription\SubscriptionUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Subscription;
use App\Helpers\Response;

class SubscriptionUpdateController extends Controller
{
    public function action(SubscriptionUpdateRequest $request, string $id): JsonResponse
    {
        $subscription = Subscription::find($id);

        if ($subscription) {
            [
                'duration_text' => $durationText,
                'description' => $description,
                'duration' => $duration,
                'price' => $price,
                'name' => $name,
            ] = $request;

            DB::beginTransaction();

            try {
                $subscription->update([
                    'duration_text' => $durationText,
                    'description' => $description,
                    'duration' => $duration,
                    'price' => $price,
                    'name' => $name,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah langganan', data: $subscription);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah langganan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Langganan tidak dapat ditemukan');
    }
}
