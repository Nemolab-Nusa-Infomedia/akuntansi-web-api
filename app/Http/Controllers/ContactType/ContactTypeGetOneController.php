<?php

namespace App\Http\Controllers\ContactType;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\ContactType;
use App\Helpers\Response;

class ContactTypeGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $contactType = ContactType::find($id);

        if ($contactType) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan tipe kontak', data: $contactType);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Tipe kontak tidak dapat ditemukan');
    }
}
