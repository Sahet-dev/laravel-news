<?php

namespace App\Repositories;

use App\Models\NewsArticle;
use Illuminate\Database\Eloquent\Collection;

class NewsArticleRepository
{
    public function getAll()
    {
        return NewsArticle::with('category')->get();
    }

    public function getById($id)
    {
        return NewsArticle::with('category')->findOrFail($id);
    }

    public function getByCategory($categoryName, $limit = 20)
    {
        return NewsArticle::whereHas('category', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        })->latest()->limit($limit)->get();
    }

    public function getLatest($limit = 100): Collection
    {
        return NewsArticle::with('category:id,name')->latest()->limit($limit)->get();
    }

    public function create($data)
    {
        return NewsArticle::create($data);
    }

    public function update($id, $data)
    {
        $article = NewsArticle::findOrFail($id);
        $article->update($data);
        return $article;
    }

    public function delete($id)
    {
        return NewsArticle::destroy($id);
    }
}

