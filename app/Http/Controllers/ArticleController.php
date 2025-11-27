<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $categoryId = $request->get('category');
        $search = $request->get('search');
        
        $data = $this->articleService->getForIndex(10, $categoryId, $search);
        
        return view('articles.index', $data);
    }

    public function destroy(Article $article)
    {
        $this->articleService->delete($article);
        
        return redirect()->route('articles.index')
            ->with('success', 'Article supprimé avec succès!');
    }
}