<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Company;

class CompanyGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $company = Company::find($id);

        if ($company) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan perusahaan', data: $company);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Perusahaan tidak dapat ditemukan');
    }
}
