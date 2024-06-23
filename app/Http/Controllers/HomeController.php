<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function __invoke(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $articles = Article::query()
//            ->with('comments') // eager load
//            ->whereHas('comments', fn($query) => $query->where('user_id', 1))
            ->whereRelation('comments', fn($query) => $query->where('user_id', 1))
            ->paginate(5);

        return view('home', compact('articles'));
    }
}
