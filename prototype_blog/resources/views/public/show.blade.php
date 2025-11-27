@extends('layouts.public')

@section('title', $article->title)

@section('content')
    <div class="max-w-4xl mx-auto">
        
        <!-- Article Header -->
        <div class="mb-8 text-center">
            <div class="flex justify-center gap-2 mb-4">
                @foreach($article->categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" class="inline-block bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full hover:bg-blue-200 transition">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $article->title }}
            </h1>
            <div class="flex items-center justify-center text-gray-500 text-sm md:text-base">
                <div class="flex items-center mr-6">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3 text-lg">
                        {{ substr($article->user->name ?? 'A', 0, 1) }}
                    </div>
                    <span>{{ $article->user->name ?? 'Admin' }}</span>
                </div>
                <div class="flex items-center">
                    <i class="far fa-calendar-alt mr-2"></i>
                    {{ $article->created_at->format('F d, Y') }}
                </div>
            </div>
        </div>

        <!-- Article Image (Placeholder if needed) -->
        <!-- <div class="rounded-2xl overflow-hidden shadow-lg mb-10">
            <img src="https://via.placeholder.com/1200x600" alt="{{ $article->title }}" class="w-full h-auto object-cover">
        </div> -->

        <!-- Article Content -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 mb-12">
            <div class="prose prose-lg max-w-none text-gray-800 prose-headings:text-gray-900 prose-a:text-blue-600 hover:prose-a:text-blue-800 prose-img:rounded-xl">
                {!! $article->content !!}
            </div>
        </div>

        <!-- Back Link -->
        <div class="text-center mb-12">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 font-medium transition">
                <i class="fas fa-arrow-left mr-2"></i> Back to Articles
            </a>
        </div>

    </div>
@endsection
