<?php

namespace App\Services;

use App\Models\Like;
use App\Repositories\LikeRepository;

class LikeService
{
    protected LikeRepository $likeRepository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    //create
    public function create(array $data): Like
    {
        $data = array_merge(
            [
                'users_id' => auth()->user()->id,
            ],
            $data
        );

        return $this->likeRepository->create($data);
    }

    //delete
}
