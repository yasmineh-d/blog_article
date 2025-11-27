<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display the home page with latest articles
     */
    public function index()
    {
        $articles = $this->articleService->getPublishedArticles(6);
        return view('public.home', compact('articles'));
    }

    /**
     * Display the list of articles with pagination
     */
    public function articles()
    {
        $articles = $this->articleService->getPublishedArticles(9);
        $categories = $this->articleService->getAllCategories();
        return view('public.articles', compact('articles', 'categories'));
    }

    /**
     * Display a single article
     */
    public function show($slug)
    {
        $article = $this->articleService->getArticleBySlug($slug);
        return view('public.show', compact('article'));
    }

    /**
     * Display articles by category
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = $this->articleService->getArticlesByCategory($slug, 9);
        $categories = $this->articleService->getAllCategories();
        
        return view('public.category', compact('articles', 'category', 'categories'));
    }

    /**
     * Search articles
     */
    public function search(Request $request)
    {
        $keyword = $request->input('q');
        $articles = $this->articleService->searchArticles($keyword, 9);
        $categories = $this->articleService->getAllCategories();
        
        return view('public.articles', compact('articles', 'categories', 'keyword'));
    }
}
