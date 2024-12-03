<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Repositories\Interfaces\CrudRepositoryInterface;
use App\Repositories\CrudRepository;

/**
 * Base class for all crud api controllers.
 * It requires created ModelRequest and ModelResource classes
 * to automatically process them
 */
abstract class CrudController extends ApiController
{
    protected string $modelName;

    /**
     * Repository to operate with models
     *
     * @var CrudRepositoryInterface
     */
    protected CrudRepositoryInterface $repository;

    /**
     * Model request with validation rules
     *
     * @var FormRequest
     */
    protected FormRequest $modelRequest;

    /**
     * Resource name for formatting response data
     *
     * @var string
     */
    protected string $modelResourceClassName;

    public function __construct()
    {
        if (empty($this->modelName)) {
            $this->initModelName();
        }

        $this->repository    = new CrudRepository($this->modelName);
        $this->modelRequest  = new ('\App\Http\Requests\\' . $this->modelName . 'Request');
        $this->modelResourceClassName = '\App\Http\Resources\\' . $this->modelName . 'Resource';
    }

    /**
     * Init default model name of controller
     */
    protected function initModelName()
    {
        $this->modelName = str_replace('Controller', '', (new \ReflectionClass($this))->getShortName());
    }

    /**
     * Get list of models
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $offset = $request->input('offset');
        $limit  = $request->input('limit');
        $entities = $this->repository->index($offset, $limit);

        return $this->sendResponse($this->modelResourceClassName::collection($entities));
    }

    /**
     * Get model data
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $entity = $this->repository->getById($id);

        return $this->sendResponse(new ($this->modelResourceClassName)($entity));
    }

    /**
     * Create model
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        //echo '<pre>'; print_r($request->all()); echo '</pre>';exit;

        $validator = Validator::make($request->all(), $this->modelRequest->rules());

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors(), 422);
        }

        $entity = $this->repository->store($validator->validated());

        return $this->sendResponse(new ($this->modelResourceClassName)($entity), 'Created successfully', 201);
    }

    /**
     * Update model
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->modelRequest->rules($id));

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $this->repository->update($validator->validated(), $id);

        return $this->sendResponse(
            new ($this->modelResourceClassName)($this->repository->getById($id)),
            'Updated successfully',
            200
        );
    }

    /**
     * Update model
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->repository->delete($id);

        return $this->sendResponse(message: 'Deleted successfully', code: 204);
    }
}
