@extends('layouts.public')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 md:p-12 mb-12 text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10 max-w-2xl">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Welcome to MyBlog</h1>
            <p class="text-blue-100 text-lg mb-8">Discover the latest stories, tutorials, and insights from our community of writers.</p>
            <a href="{{ route('articles.index') }}" class="inline-block bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-blue-50 transition shadow-md">
                Browse Articles
            </a>
        </div>
        <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-1/4 translate-y-1/4">
            <i class="fas fa-pen-nib text-9xl"></i>
        </div>
    </div>

    <!-- Latest Articles -->
    <div class="mb-8 flex justify-between items-end">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-3">Latest Articles</h2>
        <a href="{{ route('articles.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
            View All <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($articles as $article)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-gray-100 flex flex-col h-full group">
                <div class="p-6 flex-grow">
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach($article->categories->take(2) as $category)
                            <a href="{{ route('categories.show', $category->slug) }}" class="inline-block bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-0.5 rounded-full hover:bg-blue-100 transition">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                        <a href="{{ route('articles.show', $article->slug) }}">
                            {{ Str::limit($article->title, 60) }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                        {{ Str::limit(strip_tags($article->content), 120) }}
                    </p>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                    <div class="flex items-center text-xs text-gray-500">
                        <i class="far fa-calendar-alt mr-1"></i>
                        {{ $article->created_at->format('M d, Y') }}
                    </div>
                    <a href="{{ route('articles.show', $article->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Read More
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white rounded-xl border border-gray-100">
                <i class="far fa-newspaper text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-500">No articles published yet.</p>
            </div>
        @endforelse
    </div>
@endsection
