<?php

namespace App\Interfaces;
use App\Interfaces\Common\ICommonRepository;

interface ICategoryRepository extends ICommonRepository
{
    public function getPostByCategory($id);
}
