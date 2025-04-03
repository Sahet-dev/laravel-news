<?php

namespace App\Services;

use App\Repositories\NewsArticleRepository;
use Illuminate\Database\Eloquent\Collection;

class NewsArticleService
{
    protected NewsArticleRepository $articleRepo;

    public function __construct(NewsArticleRepository $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    public function getAllArticles(): Collection
    {
        return $this->articleRepo->getAll();
    }

    public function getArticleById($id)
    {
        return $this->articleRepo->getById($id);
    }

    public function createArticle($data)
    {
        return $this->articleRepo->create($data);
    }

    public function updateArticle($id, $data)
    {
        return $this->articleRepo->update($id, $data);
    }

    public function deleteArticle($id): int
    {
        return $this->articleRepo->delete($id);
    }
}
