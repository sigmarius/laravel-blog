<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function article(): HasOne
    {
//        return $this->hasOne(Article::class)->latestOfMany();

        return $this->articles()->one();
    }

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class)->withDefault();
    }

    public function tags(): HasManyThrough
    {
        // (что возвращаем, через какую таблицу)
        //  return $this->hasManyThrough(Tag::class, Article::class);

        // новый подход Laravel 10
        // through => указываем через какое отношение в рамках исходной модели (User)
        // has => указываем отношение в модели Articles, через которое
        // будем получать нужные данные
        return $this->through('articles')->has('tags');
    }

    public function tag(): HasOneThrough
    {
        // (что возвращаем, через какую таблицу)
        // return $this->hasOneThrough(Tag::class, Article::class);

        // новый подход Laravel 10
        return $this->through('articles')->has('tag');
    }
}
