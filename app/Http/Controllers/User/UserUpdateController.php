<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\User;

class UserUpdateController extends Controller
{
    public function action(UserUpdateRequest $request, string $id): JsonResponse
    {
        $user = User::find($id);

        if ($user) {
            [
                'status_account' => $statusAccount,
                'password' => $password,
                'email' => $email,
                'phone' => $phone,
                'name' => $name,

                'role_id' => $roleId,
            ] = $request;

            if (User::whereKeyNot($user->id)->where('email', $email)->first()) {
                DB::beginTransaction();

                try {
                    $user->update([
                        'status_account' => $statusAccount,
                        'password' => $password,
                        'email' => $email,
                        'phone' => $phone,
                        'name' => $name,

                        'role_id' => $roleId,
                    ]);

                    DB::commit();

                    return Response::SetAndGet(message: 'Berhasil mengubah pengguna', data: $user);
                } catch (\Exception $e) {
                    DB::rollBack();

                    return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah pengguna', $e->getMessage());
                }
            }
            return Response::SetAndGet(Response::BAD_REQUEST, 'Validasi gagal', [
                [
                    'message' => 'Alamat email telah digunakan',
                    'property' => 'email',
                ]
            ]);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Pengguna tidak dapat ditemukan');
    }
}
