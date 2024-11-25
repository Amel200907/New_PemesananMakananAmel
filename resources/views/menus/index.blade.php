@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menu List</h1>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Create Menu</a>
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
                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
