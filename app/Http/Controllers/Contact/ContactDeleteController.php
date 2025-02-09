<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Contact;

class ContactDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $contact = Contact::find($id);

        if ($contact) {
            DB::beginTransaction();

            try {
                $contact->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus kontak');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus kontak', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kontak tidak dapat ditemukan');
    }
}
