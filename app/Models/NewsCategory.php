<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get the articles that belong to this category.
     */
    public function articles()
    {
        return $this->hasMany(NewsArticle::class, 'category_id');
    }
}
