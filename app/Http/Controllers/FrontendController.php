<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', 1)->latest()->get();
        return view('frontend.index', compact('articles'));
    }

    public function show($slug)
    {
        // Cari artikel berdasarkan slug
        $article = Article::where('slug', $slug)->firstOrFail();
        
        // Tambah jumlah views
        $article->increment('views');
        
        // Tampilkan artikel dengan jumlah views yang diperbarui
        return view('frontend.show', compact('article'));
    }
}
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsToArticlesTable extends Migration
{   public function show($slug)
    {
        // Cari artikel berdasarkan slug
        $article = Article::where('slug', $slug);
        
        // Tambah jumlah views
        $article->increment('views');
        
        // Tampilkan artikel dengan jumlah views yang diperbarui
        return view('frontend.show', compact('article'));
    }
    
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedInteger('views')->default(0);
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
}
