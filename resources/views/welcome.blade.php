@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="title">Products</h1>
            </div>

            @if($products)
                @foreach ($products as $product)
                    <div class="col-12 col-md-6 col-lg-4 card px-2 py-4">
                        @if($product->photo)
                            <img class="card-img-top" src="{{ url('uploads/products') . '/' . $product->photo }}" alt="Product photo">
                        @endif
                        <div class="card-body">
                            <a href="{{ route('products.show', ['product' => $product]) }}">
                                <h3 class="card-title">{{ $product->title }}</h3>
                            </a>
                            <h5>${{ $product->price }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <a href="/cart" class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
