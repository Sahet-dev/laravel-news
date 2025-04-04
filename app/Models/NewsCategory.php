<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get the articles that belong to this category.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(NewsArticle::class, 'category_id');
    }
}
