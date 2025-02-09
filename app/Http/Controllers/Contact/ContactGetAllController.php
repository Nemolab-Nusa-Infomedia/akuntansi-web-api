<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Models\Contact;

class ContactGetAllController extends Controller
{
    public function action(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $contacts = Contact::query();

        if ($search) {
            $contacts->whereAny(
                [
                    'billing_address',
                    'payment_address',
                    'name_bank',
                    'identity',
                    'no_bank',
                    'pt_name',
                    'email',
                    'phone',
                    'name',
                ],
                'LIKE',
                "%$search%"
            );
        }

        $contacts = $contacts->latest()->get();

        return Response::SetAndGet(message: 'Berhasil mendapatkan daftar kontak', data: $contacts);
    }
}
