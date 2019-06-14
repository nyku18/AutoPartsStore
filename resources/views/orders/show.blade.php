@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-secondary text-white">Order {{ $order->id }}</div>
          <div class="card-body">
            @php
              $total=0;
            @endphp
            <ul class="list-group list-group-flush">
                @foreach ($order->products as $product)
                  @php
                    $total+=$product->pivot->product_price * $product->pivot->amount;
                  @endphp
                  <li class="list-group-item">
                    <a href="{{ route('products.show', ['product' => $product]) }}">
                      {{ $product->title}}
                    </a>
                    <p class="card-text">
                        <span class="font-weight-bold">Price: </span>
                        {{ $product->pivot->product_price }}
                    </p>
                    <p class="card-text">
                        <span class="font-weight-bold">Amount: </span>
                        {{ $product->pivot->amount }}
                    </p>
                  </li>
                @endforeach
              </ul>
              <h3 class="mt-3">Total: {{ $total }} </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
