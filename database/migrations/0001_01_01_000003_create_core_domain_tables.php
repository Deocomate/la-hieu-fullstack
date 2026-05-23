<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. SETTINGS & PAGES
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->comment("Phân loại: 'general', 'contact', 'social', 'footer'");
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('title');
            
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_bg_text')->nullable();
            $table->json('hero_images')->nullable();
            
            $table->json('content')->nullable();
            
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_image')->nullable();
            
            $table->timestamps();
        });

        // 2. EVENT ALBUMS
        Schema::create('event_albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->date('event_date')->nullable();
            $table->string('hero_bg_text')->nullable();
            $table->string('cover_image')->nullable();
            
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            $table->integer('priority')->default(0);
            $table->enum('status', ['draft', 'published', 'hidden'])->default('published');
            
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_image')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'is_featured']);
            $table->index('priority');
            $table->index('slug');
        });

        // 3. FACES & PLACES ALBUMS
        Schema::create('faces_places_albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('hero_bg_text')->nullable();
            
            $table->integer('priority')->default(0);
            $table->enum('status', ['draft', 'published', 'hidden'])->default('published');
            
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_image')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
        });

        // 4. ARTICLE CATEGORIES & ARTICLES (Photojournalism, Videography)
        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['photojournalism', 'videography']);
            $table->foreignId('category_id')->nullable()->constrained('article_categories')->nullOnDelete();
            
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            
            $table->string('cover_image')->nullable();
            $table->string('badge_logo')->nullable();
            
            $table->json('youtube_urls')->nullable(); // Dành cho videography
            $table->json('content_blocks')->nullable();
            
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            $table->integer('priority')->default(0);
            $table->enum('status', ['draft', 'published', 'hidden'])->default('published');
            
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_image')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            $table->index(['type', 'status', 'is_featured']);
            $table->index('priority');
            $table->index('slug');
        });

        // 5. HOMEPAGE COMPONENTS
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo_image');
            $table->string('link_url')->nullable();
            $table->integer('priority')->default(0);
            $table->enum('status', ['draft', 'published', 'hidden'])->default('published');
            $table->timestamps();
        });

        Schema::create('social_feeds', function (Blueprint $table) {
            $table->id();
            $table->string('platform')->default('instagram');
            $table->string('image_url');
            $table->string('post_url')->nullable();
            $table->integer('priority')->default(0);
            $table->enum('status', ['draft', 'published', 'hidden'])->default('published');
            $table->timestamps();
        });

        // 6. CENTRALIZED MEDIA TABLE
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->string('collection_name');
            
            $table->string('file_name');
            $table->string('file_url');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            
            $table->json('custom_properties')->nullable();
            $table->integer('priority')->default(0);
            
            $table->timestamps();

            $table->index(['model_type', 'model_id', 'collection_name'], 'media_model_index');
            $table->index('priority');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
        Schema::dropIfExists('social_feeds');
        Schema::dropIfExists('partners');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_categories');
        Schema::dropIfExists('faces_places_albums');
        Schema::dropIfExists('event_albums');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('settings');
    }
};
