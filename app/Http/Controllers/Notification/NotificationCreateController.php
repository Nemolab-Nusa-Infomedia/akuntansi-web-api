<?php

namespace App\Http\Controllers\Notification;

use App\Http\Requests\Notification\NotificationCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Notification;
use App\Helpers\Response;

class NotificationCreateController extends Controller
{
    public function action(NotificationCreateRequest $request): JsonResponse
    {
        [
            'title' => $title,
            'body' => $body,

            'receiver_id' => $receiverId,
            'sender_id' => $senderId,
        ] = $request;

        DB::beginTransaction();

        try {
            $notification = Notification::create([
                'title' => $title,
                'body' => $body,

                'receiver_id' => $receiverId,
                'sender_id' => $senderId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan notifikasi', data: $notification);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan notifikasi', $e->getMessage());
        }
    }
}
