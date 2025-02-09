<?php

namespace App\Http\Controllers\ContactType;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\ContactType;
use App\Helpers\Response;

class ContactTypeDeleteController extends Controller
{
    public function action(string $id): JsonResponse
    {
        $contactType = ContactType::find($id);

        if ($contactType) {
            DB::beginTransaction();

            try {
                $contactType->delete();

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil menghapus tipe kontak');
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menghapus tipe kontak', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Tipe kontak tidak dapat ditemukan');
    }
}
