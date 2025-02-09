<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Company;

class CompanyUpdateController extends Controller
{
    public function action(CompanyUpdateRequest $request, string $id): JsonResponse
    {
        $company = Company::find($id);

        if ($company) {
            [
                'sub_from' => $subFrom,
                'sub_to' => $subTo,
                'name' => $name,

                'location' => $location,

                'subscription_id' => $subscriptionId,
                'category_id' => $categoryId,
            ] = $request;

            DB::beginTransaction();

            try {
                $company->update([
                    'sub_from' => $subFrom,
                    'sub_to' => $subTo,
                    'name' => $name,

                    'location' => $location,

                    'subscription_id' => $subscriptionId,
                    'category_id' => $categoryId,
                ]);

                DB::commit();

                return Response::SetAndGet(message: 'Berhasil mengubah perusahaan', data: $company);
            } catch (\Exception $e) {
                DB::rollBack();

                return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal mengubah perusahaan', $e->getMessage());
            }
        }

        return Response::SetAndGet(Response::NOT_FOUND, 'Perusahaan tidak dapat ditemukan');
    }
}
