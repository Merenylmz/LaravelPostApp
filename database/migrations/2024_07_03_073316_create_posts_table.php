<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->text("slug")->unique()->nullable(true);
            $table->unsignedBigInteger("categoryId");
            $table->foreign("categoryId")->references("id")->on("categories")->onDelete("cascade");
            $table->unsignedBigInteger("userId");
            $table->foreign("userId")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
