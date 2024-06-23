<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'text'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // если используются полиморфные отношения, метод заменяетHasMany
    public function polyComments(): MorphMany
    {
        // (модель с полиморфным отношением, префикс указанный в миграции)
        return $this->morphMany(PolyComment::class, 'commentable');
    }

    // если используются полиморфные отношения, метод заменяет BelongsToMany
    public function polyTags(): MorphToMany
    {
        // (модель с полиморфным отношением, префикс указанный в миграции)
        return $this->morphToMany(PolyTag::class, 'taggable');
    }
}
