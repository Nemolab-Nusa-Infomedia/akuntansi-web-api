<?php

namespace App\Http\Controllers\UserCompany;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\UserCompany;
use App\Helpers\Response;

class UserCompanyGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $userCompany = UserCompany::find($id);

        if ($userCompany) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan pengguna perusahaan', data: $userCompany);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Pengguna perusahaan tidak dapat ditemukan');
    }
}
