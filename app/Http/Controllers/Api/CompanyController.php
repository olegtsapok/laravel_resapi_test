<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Repositories\Interfaces\CrudRepositoryInterface;
use App\Repositories\CrudRepository;

class CompanyController extends CrudController
{
}
