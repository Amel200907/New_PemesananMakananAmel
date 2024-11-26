@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menu List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->price }}</td>
                    <td>
                        @if (Auth::check() && $menu->isFavorite())
                            <form action="{{ route('menu.unfavorite', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Unfavorite</button>
                            </form>
                        @else
                            <form action="{{ route('menu.favorite', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Add to Favorites</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
