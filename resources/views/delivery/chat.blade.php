@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Delivery Chat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Chat with Delivery</h5>
            <div class="chat-box">
                <!-- Loop through messages -->
                @foreach($order->messages as $message)
                    <div class="message">
                        <p><strong>{{ $message->sender }}</strong>: {{ $message->content }}</p>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('delivery.sendMessage', $order->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="3" placeholder="Type your message..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
