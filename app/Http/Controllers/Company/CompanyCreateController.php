<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\Company\CompanyCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Models\Company;

class CompanyCreateController extends Controller
{
    public function action(CompanyCreateRequest $request): JsonResponse
    {
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
            $company = Company::create([
                'sub_from' => $subFrom,
                'sub_to' => $subTo,
                'name' => $name,

                'location' => $location,

                'subscription_id' => $subscriptionId,
                'category_id' => $categoryId,
            ]);

            DB::commit();

            return Response::SetAndGet(message: 'Berhasil menambahkan perusahaan', data: $company);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::SetAndGet(Response::INTERNAL_SERVER_ERROR, 'Gagal menambahkan perusahaan', $e->getMessage());
        }
    }
}
