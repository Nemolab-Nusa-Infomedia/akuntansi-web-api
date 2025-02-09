<?php

namespace App\Http\Controllers\Notification;

use App\Http\Requests\Notification\NotificationUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Notification;
use App\Helpers\Response;

class NotificationUpdateController extends Controller
{
    public function action(NotificationUpdateRequest $request, string $id): JsonResponse
    {
        $notification = Notification::find($id);

        if ($notification) {
            [
                'title' => $title,
                'body' => $body,

                'receiver_id' => $receiverId,
                'sender_id' => $senderId,
            ] = $request;

            DB::beginTransaction();

            try {
                $notification->update([
                    'title' => $title,
                    'body' => $body,

                    'receiver_id' => $receiverId,
                    'sender_id' => $senderId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah notifikasi', data: $notification);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah notifikasi', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Notifikasi tidak dapat ditemukan');
    }
}
