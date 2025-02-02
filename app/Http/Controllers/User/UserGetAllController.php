<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Models\User;

class UserGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $users = User::query();

        if ($search) {
            $users->whereAny(
                [
                    'email',
                    'phone',
                    'name',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $users = $users->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar pengguna', data: $users);
    }
}
