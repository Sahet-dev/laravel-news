<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="NewsArticle",
 *     type="object",
 *     title="News Article",
 *     required={"title", "content", "category_id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The unique identifier of the news article",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Title of the news article",
 *         example="Breaking News"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         description="Content of the news article",
 *         example="Detailed news content here..."
 *     ),
 *     @OA\Property(
 *         property="image_url",
 *         type="string",
 *         description="URL to the article's image",
 *         example="http://example.com/image.jpg"
 *     ),
 *     @OA\Property(
 *         property="published_at",
 *         type="string",
 *         format="date-time",
 *         description="Publication date of the news article",
 *         example="2025-04-02T12:00:00Z"
 *     ),
 *     @OA\Property(
 *         property="category_id",
 *         type="integer",
 *         description="The ID of the associated news category",
 *         example=1
 *     )
 * )
 */
class NewsArticle
{
    // This class is used solely for documentation purposes.
}
