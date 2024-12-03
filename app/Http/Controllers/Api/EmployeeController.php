<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Repositories\Interfaces\CrudRepositoryInterface;
use App\Repositories\CrudRepository;

class EmployeeController extends CrudController
{
    /**
     * Get employees of company
     * 
     * @param int $companyId
     * @return JsonResponse
     */
    public function employees(int $companyId): JsonResponse
    {
        $company = (new CrudRepository('Company'))->getById($companyId);

        return $this->sendResponse(
            $this->modelResourceClassName::collection($company->employees)
        );
    }
}
