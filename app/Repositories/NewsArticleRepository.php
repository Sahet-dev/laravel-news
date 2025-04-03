<?php

namespace App\Repositories;

use App\Models\NewsArticle;

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
