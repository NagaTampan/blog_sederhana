<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10); // Ambil artikel terbaru dengan paginasi
        return view('home', compact('articles'));
    }
}
