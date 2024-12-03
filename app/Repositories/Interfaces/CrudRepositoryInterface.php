<?php

namespace App\Repositories\Interfaces;

interface CrudRepositoryInterface
{
    public function index($offset, $limit);
    public function getById($id);
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
}
