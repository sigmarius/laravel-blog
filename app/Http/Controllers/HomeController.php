<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function __invoke(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $blog = Blog::find(1);
        $article = Article::find(1);

        dump($article->polyTags()->create([
            'title' => 'Tag #1'
        ]));

        $users = User::query()
            ->select(['id', 'name', 'email'])
            ->paginate(5);

        return view('home', compact('users'));
    }
}
