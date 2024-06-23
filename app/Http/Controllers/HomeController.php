<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function __invoke(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $article = Article::find(1);

        $article->categories()->sync([
            1 => [
                'is_published' => true,
                'priority' => 100
            ],
            2 => [
                'is_published' => false,
                'priority' => 90
            ]
        ]);

        foreach ($article->categories as $category) {
            dump($category->pivot->is_published);
        }

        $users = User::query()
            ->select(['id', 'name', 'email'])
            ->paginate(5);

        return view('home', compact('users'));
    }
}
