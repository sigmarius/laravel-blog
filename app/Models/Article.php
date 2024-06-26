<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'text',
        'thumbnail'
    ];

    public function thumbnailUrl(): Attribute
    {
        return Attribute::make(get: fn() => Storage::url($this->thumbnail));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // если используются полиморфные отношения, метод заменяет HasMany
    public function polyComments(): MorphMany
    {
        // (модель с полиморфным отношением, префикс указанный в миграции)
        return $this->morphMany(PolyComment::class, 'commentable');
    }

    // если используются полиморфные отношения, метод заменяет HasOne
    public function latestPolyComment(): MorphOne
    {
        // (модель с полиморфным отношением, префикс указанный в миграции)
        return $this->morphOne(PolyComment::class, 'commentable')->latestOfMany();
    }

    public function tag(): HasOne
    {
        return $this->hasOne(Tag::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    // если используются полиморфные отношения, метод заменяет BelongsToMany
    public function polyTags(): MorphToMany
    {
        // (модель с полиморфным отношением, префикс указанный в миграции)
        return $this->morphToMany(PolyTag::class, 'taggable');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
            // показывает временные поля для связующей таблицы
            ->withTimestamps()
            // показывает дополнительные поля из связующей таблицы
            ->withPivot('is_published', 'priority');
    }
}
