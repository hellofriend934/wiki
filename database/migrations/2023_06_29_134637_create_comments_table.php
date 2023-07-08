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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('commentable_id');
            $table->string('commentable_type');
            $table->foreignIdFor(\App\Models\User::class);
            $table->text('text');
            $table->foreignIdFor(\App\Models\Comment::class,'comment_reply_id')->nullable();
            $table->foreignIdFor(\App\Models\User::class,'user_reply_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
