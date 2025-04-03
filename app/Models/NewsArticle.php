<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image_url', 'published_at', 'category_id'];

    /**
     * Get the category that this article belongs to.
     */
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }
}
