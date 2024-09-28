@extends('app')

@section('title','Articles')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eagle News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .shadow-control {
            filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.4));
        }
        .card {
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<!-- Carousel Banner -->
<div id="carouselBanner" class="carousel slide mb-4 animate__animated animate__fadeIn" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://picsum.photos/1920/1080?random=1" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Banner 1">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h2 class="animate__animated animate__slideInDown">Welcome to Eagle News</h2>
                <p class="animate__animated animate__slideInUp">Stay updated with the latest news and updates.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://picsum.photos/1920/1080?random=2" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Banner 2">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h2 class="animate__animated animate__slideInDown">Breaking News</h2>
                <p class="animate__animated animate__slideInUp">Get the latest breaking news from around the world.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://picsum.photos/1920/1080?random=3" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Banner 3">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h2 class="animate__animated animate__slideInDown">Trending Today</h2>
                <p class="animate__animated animate__slideInUp">Check out what's trending in the news.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev shadow-control" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next shadow-control" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Trending Today Section -->
<div class="container mb-5 animate__animated animate__fadeIn">
    <h2 class="mb-4 text-center">Trending Today</h2>
    <div class="row">
        @foreach($articles->take(3) as $index => $article)
        <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: {{ $index * 0.1 }}s">
            <a href="{{ route('frontend.show', $article->slug) }}" class="text-decoration-none text-dark">
                <div class="card h-100 shadow border-0">
                    <img src="{{ asset('images/' . $article->img) }}" class="card-img-top" alt="{{ $article->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text flex-grow-1">{{ substr($article->desc, 0, 100) }}{{ strlen($article->desc) > 100 ? '...' : '' }}</p>
                        <button class="btn btn-primary mt-2">Read More</button>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<!-- Recent News Section -->
<div class="container mb-5 animate__animated animate__fadeIn" style="animation-delay: 0.5s">
    <h2 class="mb-4 text-center">Recent News</h2>
    <div class="row">
        @foreach($articles->take(5) as $index => $article)
        <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: {{ ($index + 5) * 0.1 }}s">
            <a href="{{ route('frontend.show', $article->slug) }}" class="text-decoration-none text-dark">
                <div class="card h-100 shadow border-0">
                    <img src="{{ asset('images/' . $article->img) }}" class="card-img-top" alt="{{ $article->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text flex-grow-1">{{ substr($article->desc, 0, 100) }}{{ strlen($article->desc) > 100 ? '...' : '' }}</p>
                        <button class="btn btn-outline-primary mt-2">Read More</button>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection