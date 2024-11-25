@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Orders</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Menu</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->menu->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.order.updateStatus', $order->id) }}">
                            @csrf
                            <select name="status" class="form-control">
                                <option {{ $order->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option {{ $order->status == 'Dalam Pengiriman' ? 'selected' : '' }}>Dalam Pengiriman</option>
                                <option {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                        <form method="POST" action="{{ route('admin.order.delete', $order->id) }}" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
