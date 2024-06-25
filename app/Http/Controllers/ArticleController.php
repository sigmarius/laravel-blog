<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $articles = Article::query()
            ->select(['id', 'title', 'created_at', 'user_id'])
            ->with(['user:id,name'])
            ->withCount('comments')
            ->latest()
            ->paginate(5);

        return view('articles.index', compact('articles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return $this->form(new Article());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        Article::query()->create($request->validated());

        return redirect()->route('articles.index')
            ->with('message', ' Статья успешно сохранена');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): \Illuminate\Foundation\Application|Factory|View|Application
    {
        return $this->form($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update($request->validated());

        return redirect()->route('articles.index')
            ->with('message', ' Статья успешно отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('articles.index')
            ->with('message', ' Статья успешно удалена');
    }

    private function form(Article $article): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $users = User::query()->pluck('name', 'id')
            ->toArray();

        return view('articles.form', [
            'users' => $users,
            'article' => $article
        ]);
    }
}
