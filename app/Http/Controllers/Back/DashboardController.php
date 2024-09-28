<?php
namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data artikel dan views
        $articles = Article::select('title', 'views')->get();
        
        // Mengirimkan data ke view
        return view('back.dashboard.index', compact('articles'));
    }
}
