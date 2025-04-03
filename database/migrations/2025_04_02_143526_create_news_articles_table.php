<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image_url')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('category_id')->constrained('news_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_articles');
    }
};
