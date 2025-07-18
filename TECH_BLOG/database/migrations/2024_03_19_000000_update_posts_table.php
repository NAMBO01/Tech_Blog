<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['excerpt', 'featured_image', 'author_id', 'published_at']);

            // Add new columns
            $table->text('summary')->nullable()->after('slug');
            $table->string('video_url')->nullable()->after('content');
            $table->string('cover_image')->nullable()->after('video_url');
            $table->foreignId('field_id')->nullable()->after('category_id')->constrained('fields')->onDelete('set null');
            $table->string('status')->default('draft')->after('field_id');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['summary', 'video_url', 'cover_image', 'field_id', 'status']);

            // Restore old columns
            $table->text('excerpt')->nullable();
            $table->string('featured_image')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('published_at')->nullable();
        });
    }
};
