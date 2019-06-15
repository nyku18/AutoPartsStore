@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-secondary text-white">Order no. {{ $order->id }}</div>
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
                  <div class="my-3 d-flex justify-content-between align-items-center">
                    @if($product->photo)
                      <img class="" width="150" height="75" src="{{ url('uploads/products') . '/' . $product->photo }}?v={{ time() }}" alt="Product photo">
                    @endif
                    <a href="{{ route('products.show', ['product' => $product]) }}">
                      <h4 class="">{{ $product->title }}</h4>
                    </a>

                    <h5 class="font-weight-bold">Quantity: {{ $product->pivot->amount }}</h5>
                    <h5 class="font-weight-bold">€{{ $product->pivot->product_price }}</h5>
                  </div>
                </li>
              @endforeach
            </ul>

            <div class="d-flex flex-column justify-content-center align-items-end">
              <h3 class="mt-3 font-weight-bold">Total: €{{ $total }} </h3>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
