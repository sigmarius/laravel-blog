<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function __invoke(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query()
            ->select(['id', 'name', 'email'])
            ->paginate(5);

        return view('home', compact('users'));
    }
}
