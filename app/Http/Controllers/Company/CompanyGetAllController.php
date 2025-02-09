<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Models\Company;

class CompanyGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $companies = Company::query();

        if ($search) {
            $companies->whereAny(
                [
                    'location',
                    'sub_from',
                    'sub_to',
                    'name',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $companies = $companies->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar perusahaan', data: $companies);
    }
}
