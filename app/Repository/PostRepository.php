<?php

namespace App\Repository;
use App\Interfaces\IPostRepository;
use App\Models\Post;
use App\Repository\Common\CommonRepositoryTrait;

class PostRepository implements IPostRepository
{
    
    use CommonRepositoryTrait;

    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->model = $this->post;
    }
}
