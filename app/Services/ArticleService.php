<?php 

namespace App\Services;

use App\Models\Article;
use App\Models\Category;

class ArticleService {
    
    public function getForIndex($perPage = 10, $categoryId = null, $search = null){
        $categories = Category::orderBy('name')->get();
        $query = Article::with('categories')->orderBy('created_at', 'desc');

        if($categoryId){
            $query->whereHas('categories', function($q) use($categoryId){
                $q->where('categories.id', $categoryId);
            });
        }

        if($search){
            $query->where(function($q) use($search){
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('excerpt', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        return [
            'articles' => $query->paginate($perPage)->appends([
                'category' => $categoryId,
                'search' => $search
            ]),
            'categories' => $categories,
            'selectedCategory' => $categoryId,
            'search' => $search,
        ];
    }

    public function delete(Article $article): void{
        $article->delete();
    }
}