<?php

namespace App\Repositories;

use App\Models\Like;

class LikeRepository
{
    public Like $model;

    public function __construct(Like $model)
    {
        $this->model = $model;
    }
}
