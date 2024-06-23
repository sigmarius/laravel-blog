<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PolyTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'taggable_id',
        'taggable_type',
    ];

    // если используются полиморфные отношения, метод заменяет BelongsTo
    public function taggable(): MorphTo
    {
        return $this->morphTo();
    }

    public function articles(): MorphToMany
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function blogs(): MorphToMany
    {
        return $this->morphedByMany(Blog::class, 'taggable');
    }
}
