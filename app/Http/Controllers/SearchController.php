<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $articles = Article::where('title', 'like', "%{$query}%")
            ->orWhere('desc', 'like', "%{$query}%")
            ->latest()
            ->get();

        return view('frontend.search', compact('articles'));
    }
}
