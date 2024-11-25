@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $menu->name }}</h1>
    <p>{{ $menu->description }}</p>
    <p><strong>Price:</strong> Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
    <h2>Average Rating: {{ number_format($menu->averageRating(), 1) }}/5</h2>

    <hr>

    <h3>Ratings and Reviews</h3>
    @foreach ($menu->ratings as $rating)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>{{ $rating->user->name }}</strong> - Rated: {{ $rating->rating }}/5</p>
                <p>{{ $rating->comment }}</p>
                <small>Posted on: {{ $rating->created_at->format('d M Y') }}</small>
            </div>
        </div>
    @endforeach

    @auth
        <h4>Give Your Rating</h4>
        <form action="{{ route('rating.store', $menu->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select name="rating" id="rating" class="form-control" required>
                    <option value="1">1 - Poor</option>
                    <option value="2">2 - Fair</option>
                    <option value="3">3 - Good</option>
                    <option value="4">4 - Very Good</option>
                    <option value="5">5 - Excellent</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Rating</button>
        </form>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to give your rating.</p>
    @endauth
</div>
@endsection
