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

    public function delete(int $id): bool
    {
        $this->likeRepository->delete($id);

        return true;
    }

    public function findOrFail(int $id): Like
    {
        return $this->likeRepository->findOrFail($id);
    }
}
