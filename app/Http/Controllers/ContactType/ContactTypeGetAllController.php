<?php

namespace App\Http\Controllers\ContactType;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\ContactType;
use App\Helpers\Response;

class ContactTypeGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $contactTypes = ContactType::query();

        if ($search) {
            $contactTypes->whereAny(
                [
                    'name'
                ],
                'LIKE',
                "%$search%"
            );
        }

        $contactTypes = $contactTypes->orderBy('name')->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar tipe kontak', data: $contactTypes);
    }
}
