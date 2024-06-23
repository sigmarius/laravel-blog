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
        $user = User::find(1);

        dump($user->tag);

        $users = User::query()
            ->select(['id', 'name', 'email'])
            ->paginate(5);

        return view('home', compact('users'));
    }
}
