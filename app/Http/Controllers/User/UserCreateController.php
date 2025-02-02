<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\User;

class UserCreateController extends Controller
{
    public function action(UserCreateRequest $request): JsonResponse
    {
        [
            'status_account' => $statusAccount,
            'password' => $password,
            'email' => $email,
            'phone' => $phone,
            'name' => $name,

            'role_id' => $roleId,
        ] = $request;

        DB::beginTransaction();

        try {
            $user = User::create([
                'status_account' => $statusAccount,
                'password' => $password,
                'email' => $email,
                'phone' => $phone,
                'name' => $name,

                'role_id' => $roleId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan pengguna', data: $user);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan pengguna', $e->getMessage());
        }
    }
}
