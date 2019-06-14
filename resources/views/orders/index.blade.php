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
                        {{ $order->created_at }} - {{ $order->id }} - {{ $order->status }}
                      </a>
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
