<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Contact;

class ContactGetOneController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $contact = Contact::find($id);

        if ($contact) {
            return Response::SetAndGet(message: 'Berhasil mendapatkan kontak', data: $contact);
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kontak tidak dapat ditemukan');
    }
}
