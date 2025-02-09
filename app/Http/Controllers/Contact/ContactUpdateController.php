<?php

namespace App\Http\Controllers\Contact;

use App\Http\Requests\Contact\ContactUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Contact;

class ContactUpdateController extends Controller
{
    public function action(ContactUpdateRequest $request, string $id): JsonResponse
    {
        $contact = Contact::find($id);

        if ($contact) {
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
                $contact->update([
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

                return Response::SetAndGet(message: 'Berhasil mengubah kontak', data: $contact);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah kontak', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Kontak tidak dapat ditemukan');
    }
}
