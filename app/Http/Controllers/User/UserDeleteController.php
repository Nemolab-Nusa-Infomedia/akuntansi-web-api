<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\User;

class UserDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $user = User::find($id);

        if ($user) {
            DB::beginTransaction();

            try {
                $user->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus pengguna');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus pengguna', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Pengguna tidak dapat ditemukan');
    }
}
