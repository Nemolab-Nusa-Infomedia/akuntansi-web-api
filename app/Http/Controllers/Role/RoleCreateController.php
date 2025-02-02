<?php

namespace App\Http\Controllers\Role;

use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Role;

class RoleCreateController extends Controller
{
    public function action(RoleCreateRequest $request): JsonResponse
    {
        [
            'name' => $name
        ] = $request;

        DB::beginTransaction();

        try {
            $role = Role::create([
                'name' => $name,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan akses', data: $role);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan akses', $e->getMessage());
        }
    }
}
