<?php

namespace App\Http\Controllers\ContactType;

use App\Http\Requests\ContactType\ContactTypeUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\ContactType;
use App\Helpers\Response;

class ContactTypeUpdateController extends Controller
{
    public function action(ContactTypeUpdateRequest $request, string $id): JsonResponse
    {
        $contactType = ContactType::find($id);

        if ($contactType) {
            [
                'name' => $name
            ] = $request;

            DB::beginTransaction();

            try {
                $contactType->update([
                    'name' => $name
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah tipe kontak', data: $contactType);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah tipe kontak', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Tipe kontak tidak dapat ditemukan');
    }
}
