@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Deliveries</h1>
    <a href="{{ route('deliveries.create') }}" class="btn btn-primary mb-3">Add Delivery</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deliveries as $delivery)
                <tr>
                    <td>{{ $delivery->id }}</td>
                    <td>{{ $delivery->order_id }}</td>
                    <td>{{ $delivery->status }}</td>
                    <td>
                        <a href="{{ route('deliveries.edit', $delivery->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('deliveries.destroy', $delivery->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
