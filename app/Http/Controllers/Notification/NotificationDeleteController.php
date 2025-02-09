<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Notification;
use App\Helpers\Response;

class NotificationDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $notification = Notification::find($id);

        if ($notification) {
            DB::beginTransaction();

            try {
                $notification->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus notifikasi');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus notifikasi', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Notifikasi tidak dapat ditemukan');
    }
}
