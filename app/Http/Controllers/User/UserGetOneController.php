<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\User;

class UserGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $user = User::find($id);

        if ($user) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan pengguna', data: $user);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Pengguna tidak dapat ditemukan');
    }
}
