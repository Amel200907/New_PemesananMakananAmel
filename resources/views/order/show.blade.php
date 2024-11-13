@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order ID: {{ $order->id }}</h5>
            <p><strong>Menu:</strong> {{ $order->menu->name }}</p>
            <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
        </div>
    </div>
</div>
@endsection
