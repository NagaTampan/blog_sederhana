@extends('app')

@section('content')
@section('title', 'Read More')

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-wrapper {
            flex: 1 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-light">
    <div class="content-wrapper p-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-12">
                    <div class="card shadow animate__animated animate__fadeIn">
                        <img src="{{ asset('images/' . $article->img) }}" class="card-img-top img-fluid" style="height: 300px; object-fit: cover;" alt="{{ $article->title }}">
                        <div class="card-body">
                            <h1 class="card-title fw-bold mb-4 animate__animated animate__slideInDown display-2">{{ $article->title }}</h1>
                            <div class="d-flex justify-content-between mb-4 display-9">
                                <span class="badge bg-primary animate__animated animate__fadeInLeft">Views: {{ $article->views }}</span>
                                <span class="badge bg-secondary animate__animated animate__fadeInRight">Published: {{ $article->publish_date }}</span>
                            </div>
                            <h5 class="card-text text-muted mb-4 animate__animated animate__fadeIn animate__delay-1s text-justify">{{ $article->desc }}</h5>
                            <a href="{{ url('/') }}" class="btn btn-primary animate__animated animate__bounceIn animate__delay-2s">
                                <i class="bi bi-arrow-left"></i> Back to Blog
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
@endsection