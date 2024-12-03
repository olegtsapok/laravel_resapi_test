<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\CrudRepositoryInterface;

class CrudRepository implements CrudRepositoryInterface
{
    protected string $modelClassName;

    /**
     * Create a new class instance.
     */
    public function __construct(string $modelName = '')
    {
        $this->modelClassName = '\App\Models\\' . $modelName;

        if (!class_exists($this->modelClassName)) {
            throw new \Exception('Crud repository class doesnot exist ' . $this->modelClassName);
        }
    }

    public function index($offset = null, $limit = null)
    {
        $model = (new $this->modelClassName);
        if ($offset) {
            $model = $model->offset($offset)->limit($limit ?? 15);
        }

        return $model->get();
    }

    public function getById($id)
    {
        return $this->modelClassName::findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->modelClassName::create($data);
    }

    public function update(array $data, $id)
    {
        $entity = $this->getById($id);
        return $entity->update($data);
    }

    public function delete($id)
    {
        $entity = $this->getById($id);
        return $entity->delete();
    }
}
