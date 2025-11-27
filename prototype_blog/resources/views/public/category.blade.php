@extends('layouts.public')

@section('title', $category->name)

@section('content')
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Main Content -->
        <div class="lg:w-2/3">
            <div class="mb-6 flex items-center">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg mr-4">
                    <i class="fas fa-tag text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Category: <span class="text-blue-600">{{ $category->name }}</span>
                    </h1>
                    <p class="text-gray-600 text-sm">Found {{ $articles->total() }} articles in this category</p>
                </div>
            </div>

            <div class="space-y-6">
                @forelse($articles as $article)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-gray-100 p-6 flex flex-col md:flex-row gap-6">
                        <div class="flex-grow">
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
                        <i class="far fa-folder-open text-4xl text-gray-300 mb-3"></i>
                        <h3 class="text-lg font-medium text-gray-900">Category is empty</h3>
                        <p class="text-gray-500 mt-1">No articles found in this category yet.</p>
                        <a href="{{ route('articles.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">View all articles</a>
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
            <!-- Categories Widget -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">All Categories</h3>
                <div class="space-y-2">
                    @foreach($categories as $cat)
                        <a href="{{ route('categories.show', $cat->slug) }}" class="flex justify-between items-center group p-2 rounded-lg hover:bg-gray-50 transition {{ $cat->id === $category->id ? 'bg-blue-50' : '' }}">
                            <span class="text-gray-700 group-hover:text-blue-600 font-medium transition {{ $cat->id === $category->id ? 'text-blue-600' : '' }}">{{ $cat->name }}</span>
                            <span class="bg-gray-100 text-gray-500 text-xs font-semibold px-2 py-1 rounded-full group-hover:bg-blue-100 group-hover:text-blue-600 transition {{ $cat->id === $category->id ? 'bg-blue-100 text-blue-600' : '' }}">
                                {{ $cat->articles()->where('status', 'published')->count() }}
                            </span>
                        </a>
                    @endforeach
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100 text-center">
                    <a href="{{ route('articles.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                        View All Articles
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
