<?php

namespace App\Services;

use App\Repositories\NewsArticleRepository;
use App\Repositories\NewsCategoryRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsArticleService
{
    protected NewsArticleRepository $articleRepo;
    protected NewsCategoryRepository $categoryRepo;

    public function __construct(
        NewsArticleRepository $articleRepo,
        NewsCategoryRepository $categoryRepo
    ) {
        $this->articleRepo = $articleRepo;
        $this->categoryRepo = $categoryRepo;
    }

    // Retrieve up to 20 articles for a given category with caching
    public function getArticlesByCategory(string $categoryName)
    {
        return Cache::remember("articles_category_{$categoryName}", now()->addMinutes(30), function () use ($categoryName) {
            return $this->articleRepo->getByCategory($categoryName, 20);
        });
    }

    // Retrieve up to 100 most recent articles, globally cached
    public function getLatestArticles()
    {
        return Cache::remember("latest_articles", now()->addMinutes(30), function () {
            return $this->articleRepo->getLatest(100);
        });
    }

    // Create an article, ensuring the category exists
    public function createArticle(array $data)
    {
        DB::beginTransaction();

        try {
            // Ensure category exists or create it
            $category = $this->categoryRepo->findByName($data['category_name']);
            if (!$category) {
                $category = $this->categoryRepo->create(['name' => $data['category_name']]);
            }
            $data['category_id'] = $category->id;

            // Create the article
            $article = $this->articleRepo->create($data);

            // Clear related cache
            Cache::forget("articles_category_{$data['category_name']}");
            Cache::forget("latest_articles");

            DB::commit();
            return $article;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to create article: " . $e->getMessage());
            throw new \Exception("An error occurred while creating the article.");
        }
    }

    // Update an article and clear related caches
    public function updateArticle($id, array $data)
    {
        DB::beginTransaction();

        try {
            $article = $this->articleRepo->getById($id);
            $oldCategoryName = $article->category->name;

            // Update article
            $this->articleRepo->update($id, $data);

            // Clear caches
            Cache::forget("articles_category_{$oldCategoryName}");
            Cache::forget("articles_category_{$data['category_name']}");
            Cache::forget("latest_articles");

            DB::commit();
            return $article;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to update article: " . $e->getMessage());
            throw new \Exception("An error occurred while updating the article.");
        }
    }

    // Delete an article and clear related caches
    public function deleteArticle($id): true
    {
        DB::beginTransaction();

        try {
            $article = $this->articleRepo->getById($id);
            $categoryName = $article->category->name;

            // Delete the article
            $this->articleRepo->delete($id);

            // Clear caches
            Cache::forget("articles_category_{$categoryName}");
            Cache::forget("latest_articles");

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to delete article: " . $e->getMessage());
            throw new \Exception("An error occurred while deleting the article.");
        }
    }
}
