<?php

namespace App\Http\Controllers\ContactType;

use App\Http\Requests\ContactType\ContactTypeCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\ContactType;
use App\Helpers\Response;

class ContactTypeCreateController extends Controller
{
    public function action(ContactTypeCreateRequest $request): JsonResponse
    {
        [
            'name' => $name
        ] = $request;

        DB::beginTransaction();

        try {
            $contactType = ContactType::create([
                'name' => $name,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan tipe kontak', data: $contactType);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan tipe kontak', $e->getMessage());
        }
    }
}
