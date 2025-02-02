<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Role;

class RoleGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $role = Role::find($id);

        if ($role) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan akses', data: $role);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Akses tidak dapat ditemukan');
    }
}
