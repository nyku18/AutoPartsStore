@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if($products)
                @foreach ($products as $product)
                    <div class="col-12 col-md-6 col-lg-4 my-4">
                          @if($product->photo)
                              <img class="card-img-top" src="{{ url('uploads/products') . '/' . $product->photo }}?v={{ time() }}" alt="Product photo">
                          @endif
                            <a href="{{ route('products.show', ['product' => $product]) }}">
                                <h3 class="card-title">{{ $product->title }}</h3>
                            </a>
                            <h5 class="font-weight-bold">€{{ $product->price }}</h5>
                            <h5 class="font-weight-bold">Amount: {{ $cart->products()->findOrFail($product->id, ['amount'])->pivot->amount }}</h5>
                            <a href="{{ route('cart.destroy', ['product' => $product]) }}" class="btn btn-primary">Remove from cart</a>
                        </div>
                @endforeach
              @else
                <h3>You have no products in cart!</h3>
            @endif
        </div>
    </div>
@endsection
