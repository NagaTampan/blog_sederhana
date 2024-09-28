@extends('app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container">
    <h1>Search Results</h1>
    @if($articles->isEmpty())
        <p>No articles found.</p>
    @else
        <ul>
        <div class="row">
        @foreach($articles as $article)
        <div class="col-md-4 mb-4 mt-3">
            <div class="card">
                <img src="{{ asset('images/' . $article->img) }}" class="card-img-top" alt="{{ $article->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ \Str::limit($article->categories, 100) }}</p>
                    <p class="card-text">{{ \Str::limit($article->desc, 100) }}</p>
                    <a href="{{ route('frontend.show', $article->slug) }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
        </ul>
    @endif
</div>
@endsection