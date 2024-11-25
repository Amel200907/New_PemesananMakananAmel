@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Delivery Orders</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Menu</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Delivery Status</th>
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
                    <td>{{ $order->delivery_status }}</td>
                    <td>
                        <form method="POST" action="{{ route('delivery.updateStatus', $order->id) }}">
                            @csrf
                            <select name="status" class="form-control">
                                <option {{ $order->delivery_status == 'Dalam Pengiriman' ? 'selected' : '' }}>Dalam Pengiriman</option>
                                <option {{ $order->delivery_status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
