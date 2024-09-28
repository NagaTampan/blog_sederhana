@extends('app')
@section('title','Edit - Admin')
@section('content')
<!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Article</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $article->title) }}" required>
                        </div>

                        <!-- Content -->
                        <div class="form-group mb-3">
                            <label for="desc" class="form-label">Content</label>
                            <textarea id="desc" name="desc" class="form-control" required>{{ old('desc', $article->desc) }}</textarea>
                        </div>



                        <!-- Category -->
                        <div class="form-group mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" name="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                                                <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="0" {{ old('status', $article->status) == 0 ? 'selected' : '' }}>Private</option>
                                <option value="1" {{ old('status', $article->status) == 1 ? 'selected' : '' }}>Public</option>
                            </select>
                        </div>


                        <!-- Image Upload (if applicable) -->
                        <div class="form-group mb-3">
                            <label for="img" class="form-label">Image</label>
                            <input type="file" id="img" name="img" class="form-control">
                            @if($article->img)
                                <img src="{{ asset('public/images/' . $article->img) }}" alt="Current Image" class="mt-3" style="max-width: 200px;">
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
