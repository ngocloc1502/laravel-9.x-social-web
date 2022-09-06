<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    
        Schema::create('blog_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->onUpdate('cascade')->onDelete('cascade');
            $table->string('image', 100);
            $table->integer('width');
            $table->integer('height');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_view', function (Blueprint $table) {
            $table->integer('blog_id');
            $table->integer('user_id');
            $table->index(['blog_id', 'user_id']);
            $table->timestamps();
        });

        Schema::create('blog_likes', function (Blueprint $table) {
            $table->integer('blog_id');
            $table->integer('user_id');
            $table->boolean('status')->default(0);
            $table->index(['blog_id', 'user_id']);
            $table->timestamps();
        });

        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('blog_id')->constrained('blogs')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_images');
        Schema::dropIfExists('blog_view');
        Schema::dropIfExists('blog_likes');
        Schema::dropIfExists('blog_comments');
    }
};
