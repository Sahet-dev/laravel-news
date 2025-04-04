<?php

namespace App\Repositories;

use App\Models\NewsCategory;

class NewsCategoryRepository
{
    public function getAll()
    {
        return NewsCategory::all();
    }

    public function getById($id)
    {
        return NewsCategory::findOrFail($id);
    }

    public function findByName($name)
    {
        return NewsCategory::where('name', $name)->first();
    }

    public function create($data)
    {
        return NewsCategory::create($data);
    }

    public function update($id, $data)
    {
        $category = NewsCategory::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        return NewsCategory::destroy($id);
    }
}

