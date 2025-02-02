<?php

namespace App\Http\Controllers\Role;

use App\Http\Requests\Role\RoleUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Role;

class RoleUpdateController extends Controller
{
    public function action(RoleUpdateRequest $request, string $id): JsonResponse
    {
        $role = Role::find($id);

        if ($role) {
            [
                'name' => $name
            ] = $request;

            DB::beginTransaction();

            try {
                $role->update([
                    'name' => $name
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah akses', data: $role);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah akses', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Akses tidak dapat ditemukan');
    }
}
