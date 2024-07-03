<?php

namespace App\Interfaces\Common;

interface ICommonRepository
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function delete($id);
    public function update($id, array $data);
}
