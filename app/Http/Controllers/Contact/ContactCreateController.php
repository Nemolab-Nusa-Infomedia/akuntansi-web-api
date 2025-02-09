<?php

namespace App\Http\Controllers\Contact;

use App\Http\Requests\Contact\ContactCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Contact;

class ContactCreateController extends Controller
{
    public function action(ContactCreateRequest $request): JsonResponse
    {
        [
            'payment_address' => $paymentAddress,
            'billing_address' => $billingAddress,
            'name_bank' => $bankName,
            'no_bank' => $bankNumber,
            'identity' => $identity,
            'pt_name' => $ptName,
            'phone' => $phone,
            'email' => $email,
            'name' => $name,

            'type_id' => $typeId,
        ] = $request;

        DB::beginTransaction();

        try {
            $contact = Contact::create([
                'payment_address' => $paymentAddress,
                'billing_address' => $billingAddress,
                'name_bank' => $bankName,
                'no_bank' => $bankNumber,
                'identity' => $identity,
                'pt_name' => $ptName,
                'phone' => $phone,
                'email' => $email,
                'name' => $name,

                'type_id' => $typeId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan kontak', data: $contact);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan kontak', $e->getMessage());
        }
    }
}
