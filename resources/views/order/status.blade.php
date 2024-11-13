@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order Status</h1>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>
</div>
@endsection
