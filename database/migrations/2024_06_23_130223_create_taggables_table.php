<?php

use App\Models\PolyTag;
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
        Schema::create('taggables', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(PolyTag::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // в итоге получим тут taggable_id и taggable_type
            $table->morphs('taggable');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taggables');
    }
};
