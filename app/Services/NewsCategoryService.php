<?php

namespace App\Services;

use App\Repositories\NewsCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class NewsCategoryService
{
    protected NewsCategoryRepository $categoryRepo;

    public function __construct(NewsCategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepo->getAll();
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepo->getById($id);
    }

    public function createCategory($data)
    {
        return $this->categoryRepo->create($data);
    }

    public function updateCategory($id, $data)
    {
        return $this->categoryRepo->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepo->delete($id);
    }
}
