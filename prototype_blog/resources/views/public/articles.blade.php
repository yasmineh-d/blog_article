@extends('layouts.public')

@section('title', isset($keyword) ? 'Search Results' : 'Articles')

@section('content')
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Main Content -->
        <div class="lg:w-2/3">
            <div class="mb-6">
                @if(isset($keyword))
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">
                        Search Results for "<span class="text-blue-600">{{ $keyword }}</span>"
                    </h1>
                    <p class="text-gray-600 text-sm">Found {{ $articles->total() }} articles</p>
                @else
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">All Articles</h1>
                    <p class="text-gray-600 text-sm">Browse our collection of articles</p>
                @endif
            </div>

            <div class="space-y-6">
                @forelse($articles as $article)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-gray-100 p-6 flex flex-col md:flex-row gap-6">
                        <div class="flex-grow">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($article->categories as $category)
                                    <a href="{{ route('categories.show', $category->slug) }}" class="inline-block bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-0.5 rounded-full hover:bg-blue-100 transition">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mb-2 hover:text-blue-600 transition">
                                <a href="{{ route('articles.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ Str::limit(strip_tags($article->content), 160) }}
                            </p>
                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex items-center text-xs text-gray-500">
                                    <span class="flex items-center mr-4">
                                        <i class="far fa-user mr-1"></i>
                                        {{ $article->user->name ?? 'Admin' }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ $article->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Read Article <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-xl border border-gray-100">
                        <i class="fas fa-search text-4xl text-gray-300 mb-3"></i>
                        <h3 class="text-lg font-medium text-gray-900">No articles found</h3>
                        <p class="text-gray-500 mt-1">Try adjusting your search or filter to find what you're looking for.</p>
                        <a href="{{ route('articles.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">Clear filters</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $articles->appends(request()->query())->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Search Widget -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Search</h3>
                <form action="{{ route('search') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search articles..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <button type="submit" class="w-full mt-3 bg-blue-600 text-white font-medium py-2 rounded-lg hover:bg-blue-700 transition">
                        Search
                    </button>
                </form>
            </div>

            <!-- Categories Widget -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Categories</h3>
                <div class="space-y-2">
                    @foreach($categories as $cat)
                        <a href="{{ route('categories.show', $cat->slug) }}" class="flex justify-between items-center group p-2 rounded-lg hover:bg-gray-50 transition">
                            <span class="text-gray-700 group-hover:text-blue-600 font-medium transition">{{ $cat->name }}</span>
                            <span class="bg-gray-100 text-gray-500 text-xs font-semibold px-2 py-1 rounded-full group-hover:bg-blue-100 group-hover:text-blue-600 transition">
                                {{ $cat->articles()->where('status', 'published')->count() }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
