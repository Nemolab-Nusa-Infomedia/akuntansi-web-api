<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Subscription;
use App\Helpers\Response;

class SubscriptionDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $subscription = Subscription::find($id);

        if ($subscription) {
            DB::beginTransaction();

            try {
                $subscription->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus langganan');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus langganan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Langganan tidak dapat ditemukan');
    }
}
