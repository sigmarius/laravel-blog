<?php

use App\Models\Article;
use App\Models\User;
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
        Schema::create('poly_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // создаст 2 поля - 'commentable_id' + 'commentable_type'
            $table->morphs('commentable');

            // или можно описать morphs самостоятельно:
            // поле которое будет ссылаться на id сущности, на которую будет комментарий
            // пост, блог, статья и т.д.
            // пишется название текущей сущности comment + able
//            $table->integer('commentable_id');

            // название сущности на которую будет ссылаться 'commentable_id'
            // тут будет путь до класса Article, Blog, etc
//            $table->string('commentable_type');

            $table->string('text');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poly_comments');
    }
};
