<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Interface\SearchRepository;

class ArticleController extends Controller
{
    public function search_post(SearchRepository $searchRepository)
    {
        return response()->json([
            'articles' => request()->has('q')
            ? $searchRepository->search(request('q'))
            : Article::all()
        ]);
    }
}
