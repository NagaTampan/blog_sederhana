<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        // Check if the request is an AJAX request for DataTables
        if (request()->ajax()) {
            $articles = Article::with('category')->latest()->get();
            return DataTables::of($articles)
                ->addColumn('status', function ($article) {
                    return $article->status == 0
                        ? '<span class="badge bg-danger">Private</span>'
                        : '<span class="badge bg-success">Public</span>';
                })
                ->addColumn('button', function ($article) {
                    return '<div class="text-center">
                        <a href="' . route('article.show', $article->id) . '" class="btn btn-secondary">Detail</a>
                        <a href="' . route('article.edit', $article->id) . '" class="btn btn-primary">Edit</a>
                        <a href="javascript:void(0)" data-id="' . $article->id . '" class="btn btn-danger btn-delete">Delete</a>
                    </div>';
                })
                ->rawColumns(['status', 'button'])
                ->make(true);
        }
    
        // For non-AJAX requests, load the view with articles and categories
        $articles = Article::with('category')->get();
        $categories = Category::all(); // Ensure this matches your model setup
        
        return view('back.article.index', compact('articles', 'categories'));
    }
    
    public function create()
    {
        // Fetch categories for the dropdown
        $categories = Category::all();
        return view('back.article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'publish_date' => 'required|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('img')) {
            $imageName = $request->file('img')->getClientOriginalName();
            $request->file('img')->move(public_path('images'), $imageName);
            $validated['img'] = $imageName;
        }

        Article::create($validated);

        return redirect()->route('article.index')->with('success', 'Article created successfully.');
    }
    
    



    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('back.article.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all(); // Ensure this matches your model setup
        return view('back.article.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->all();
    
        // Handle image upload if present
        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($article->img && file_exists(public_path('images/' . $article->img))) {
                unlink(public_path('images/' . $article->img));
            }
            
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $data['img'] = $imageName;
        }
    
        // Generate slug if not present
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
    
        // Update article
        $article->update($data);
    
        return redirect()->route('article.index')->with('success', 'Article updated successfully.');
    }
    

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
    
        return response()->json(['success' => 'Article deleted successfully.']);
    }
    
}
