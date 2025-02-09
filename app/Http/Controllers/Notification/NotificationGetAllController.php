<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Helpers\Response;

class NotificationGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $notifications = Notification::query();

        $notifications = $notifications->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar notifikasi', data: $notifications);
    }
}
