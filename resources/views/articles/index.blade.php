@extends('layouts.app')

@section('content')
<div class="container">

    <h1 style="margin-bottom:20px;">All Articles</h1>

    {{-- Message succès --}}
    @if(session('success'))
        <div style="padding:10px; background-color:#d4edda; color:#155724; margin-bottom:15px; border-radius:5px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filtre par catégorie et recherche --}}
    <form method="GET" action="{{ route('articles.index') }}" style="margin-bottom:20px; display:flex; gap:15px; align-items:end;">
        
        {{-- Search Input --}}
        <div style="flex:1;">
            <label for="search" style="font-weight:bold; display:block; margin-bottom:5px;">Search :</label>
            <input 
                type="text" 
                name="search" 
                id="search" 
                placeholder="Search by title, excerpt or content..."
                value="{{ $search ?? '' }}"
                style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;"
            >
        </div>

        {{-- Category Filter --}}
        <div style="flex:0.5;">
            <label for="category" style="font-weight:bold; display:block; margin-bottom:5px;">Filter by category :</label>
            <select name="category" id="category" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
                <option value="">All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $selectedCategory == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Buttons --}}
        <div style="display:flex; gap:10px;">
            <button type="submit" style="padding:8px 20px; background-color:#007bff; color:white; border:none; border-radius:5px; cursor:pointer;">
                Search
            </button>
            <a href="{{ route('articles.index') }}" style="padding:8px 20px; background-color:#6c757d; color:white; border:none; border-radius:5px; text-decoration:none; display:inline-block;">
                Reset
            </a>
        </div>
    </form>

    {{-- Tableau des articles --}}
    <table style="width:100%; border-collapse: collapse; border:1px solid #ccc;">
        <thead>
            <tr style="color:black">
                <th style="padding:10px;">ID</th>
                <th style="padding:10px;">Title</th>
                <th style="padding:10px;">categories</th>
                <th style="padding:10px;">Statut</th>
                <th style="padding:10px;">Date</th>
                <th style="padding:10px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $index => $article)
                <tr style="background-color: {{ $index % 2 == 0 ? '#f9f9f9' : '#e0e0e0' }};">
                    <td style="padding:8px;">{{ $article->id }}</td>
                    <td style="padding:8px;">{{ $article->title }}</td>
                    <td style="padding:8px;">
                        @foreach($article->categories as $cat)
                            <span style="background-color:#ccc; color:black; padding:3px 6px; margin-right:3px; border-radius:3px;">
                                {{ $cat->name }}
                            </span>
                        @endforeach
                    </td>
                    <td style="padding:8px; color:black;">{{ $article->status }}</td>
                    <td style="padding:8px;">{{ $article->created_at->format('Y-m-d') }}</td>
                    <td style="padding:8px;">
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding:5px 10px; background-color:red; color:white; border:none; border-radius:3px; cursor:pointer;">
                                delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding:10px; text-align:center;">No articles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div style="margin-top:15px;">
        {{ $articles->appends(request()->query())->links() }}
    </div>

</div>
@endsection