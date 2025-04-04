<?php

namespace App\Http\Controllers;

use App\Services\NewsArticleService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class NewsArticleController
 *
 * @OA\Tag(
 *     name="News Articles",
 *     description="Operations related to news articles"
 * )
 */
class NewsArticleController extends Controller
{
    protected NewsArticleService $articleService;

    public function __construct(NewsArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * @OA\Get(
     *     path="/api/news-articles",
     *     summary="Get all news articles",
     *     tags={"News Articles"},
     *     @OA\Response(
     *         response=200,
     *         description="List of news articles",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/NewsArticle")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json($this->articleService->getLatestArticles());
    }

    /**
     * @OA\Get(
     *     path="/api/news-articles/{id}",
     *     summary="Get a specific news article by ID",
     *     tags={"News Articles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the news article",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A specific news article",
     *         @OA\JsonContent(ref="#/components/schemas/NewsArticle")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article not found"
     *     )
     * )
     */
    public function show($id)
    {
        return response()->json($this->articleService->getArticleById($id));
    }

    /**
     * @OA\Post(
     *     path="/api/news-articles",
     *     summary="Create a new news article",
     *     tags={"News Articles"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="News article data",
     *         @OA\JsonContent(ref="#/components/schemas/NewsArticle")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="News article created",
     *         @OA\JsonContent(ref="#/components/schemas/NewsArticle")
     *     )
     * )
     */
    public function store(Request $request)
    {
        return response()->json($this->articleService->createArticle($request->all()));
    }

    /**
     * @OA\Put(
     *     path="/api/news-articles/{id}",
     *     summary="Update a news article",
     *     tags={"News Articles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the news article to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated news article data",
     *         @OA\JsonContent(ref="#/components/schemas/NewsArticle")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="News article updated",
     *         @OA\JsonContent(ref="#/components/schemas/NewsArticle")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        return response()->json($this->articleService->updateArticle($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *     path="/api/news-articles/{id}",
     *     summary="Delete a news article",
     *     tags={"News Articles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the news article to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="News article deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        return response()->json($this->articleService->deleteArticle($id));
    }
}
