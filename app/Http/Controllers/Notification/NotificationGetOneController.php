<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Notification;
use App\Helpers\Response;

class NotificationGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $notification = Notification::find($id);

        if ($notification) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan notifikasi', data: $notification);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Notifikasi tidak dapat ditemukan');
    }
}
