@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Order History</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Menu</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->menu->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
