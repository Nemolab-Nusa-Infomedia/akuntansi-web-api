<?php

namespace App\Http\Controllers\UserCompany;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\UserCompany;
use App\Helpers\Response;

class UserCompanyGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $userCompanies = UserCompany::query();

        if ($search) {
            $userCompanies->whereAny(
                [
                    'role',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $userCompanies = $userCompanies->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar pengguna perusahaan', data: $userCompanies);
    }
}
