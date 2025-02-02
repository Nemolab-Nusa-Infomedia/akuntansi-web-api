<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Role;

class RoleDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $role = Role::find($id);

        if ($role) {
            DB::beginTransaction();

            try {
                $role->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus akses');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus akses', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Akses tidak dapat ditemukan');
    }
}
