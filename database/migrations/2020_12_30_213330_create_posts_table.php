<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_content')->default('0');
            $table->string('post_type', 50)->default('post');
            $table->string('post_ref', 50)->default('master');
            $table->string('post_title');
            $table->string('slug', 191)->unique();
            $table->string('source_url', 150)->unique();
            $table->bigInteger('fake_user_id')->unsigned()->nullable();
            $table->boolean('status')->default('1');
            $table->timestamp('published_at')->useCurrent();
            $table->bigInteger('view_count')->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
