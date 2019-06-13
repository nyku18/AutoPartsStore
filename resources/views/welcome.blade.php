@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-auto">
                <form action="{{ route('search') }}" method="POST" role="search" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="search_word" placeholder="Search products">
                        <button type="submit" class="btn btn-success ml-2">
                            Search
                        </button>
                    </div>
                </form>

                @if (session('search_message'))
                    <div class="alert alert-success mt-3">
                        {{ session('search_message') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-center">
            @if($products)
                @foreach ($products as $product)
                    <div class="col-12 col-md-6 col-lg-4 my-4">
                        <div class="card">
                            @if($product->photo)
                                <img class="card-img-top" src="{{ url('uploads/products') . '/' . $product->photo }}?v={{ time() }}" alt="Product photo">
                            @endif
                            <div class="card-body">
                                <a href="{{ route('products.show', ['product' => $product]) }}">
                                    <h3 class="card-title">{{ $product->title }}</h3>
                                </a>
                                <h5 class="font-weight-bold">${{ $product->price }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text seller">
                                    <span class="font-weight-bold">Seller: </span>
                                    {{ $product->user->name }}
                                </p>
                                <a href="/cart" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
