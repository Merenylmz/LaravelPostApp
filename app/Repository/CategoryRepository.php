<?php

namespace App\Repository;
use App\Interfaces\ICategoryRepository;
use App\Models\Category;
use App\Repository\Common\CommonRepositoryTrait;

class CategoryRepository implements ICategoryRepository
{
    
    use CommonRepositoryTrait;

    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->model = $this->category;
    }

    public function getPostByCategory($id){
        $category = $this->category->findOrFail($id);
        
        return json_encode($category->posts);
    }
}
