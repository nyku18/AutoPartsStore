@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-secondary text-white">All orders</div>
          <div class="card-body">
            @if ( !$orders->isEmpty() )
              <ul class="list-group list-group-flush">
                  @foreach ($orders as $order)
                    <li class="list-group-item">
                      <a href="{{ route('orders.show', ['order' => $order]) }}">
                        <h3>Order no. {{ $order->id }}</h3>
                      </a>

                      <div class="order-details">
                        <div>Ordered on {{ $order->created_at }}</div>
                        <div>Status: {{ $order->status }}</div>
                      </div>

                    </li>
                  @endforeach
                </ul>
              @else
                <h3>You have no orders!</h3>
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
