<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Models\Role;

class RoleGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $roles = Role::query();

        if ($search) {
            $roles->whereAny(
                [
                    'name'
                ],
                'LIKE',
                "%$search%"
            );
        }

        $roles = $roles->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar akses', data: $roles);
    }
}
