<?php

namespace App\Repository\Common;

use Illuminate\Database\Eloquent\Model;

trait CommonRepositoryTrait
{
    private $model;
    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function getAll(){
        $datas = $this->model->all();
        return $datas;
    }

    public function getById($id){
        $data = $this->model->findOrFail($id);
        return $data;
    }

    public function create($data){
        $status = $this->model->create($data);
        return $status;
    }

    public function update($id,$data){
        $modelData = $this->model->findOrFail($id);
        $status = $modelData->update($data);
        return $status;
    }

    public function delete($id){
        $status = $this->model->destroy($id);
        return $status;
    }
}
