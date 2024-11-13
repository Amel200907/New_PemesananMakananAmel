@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Orders</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Menu</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->menu->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processed" {{ $order->status == 'processed' ? 'selected' : '' }}>Processed</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
