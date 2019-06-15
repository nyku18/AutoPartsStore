@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 my-4">
                @if(!$products->isEmpty())
                    @php
                        $total=0;
                    @endphp

                    @foreach ($products as $product)
                        @php
                          $total+=$product->price * $product->pivot->amount;
                        @endphp
                        <div class="cart-product">
                            <div class="my-3 d-flex justify-content-between align-items-center">
                                @if($product->photo)
                                    <img class="" width="150" height="75" src="{{ url('uploads/products') . '/' . $product->photo }}?v={{ time() }}" alt="Product photo">
                                @endif
                                <a href="{{ route('products.show', ['product' => $product]) }}">
                                    <h4 class="">{{ $product->title }}</h4>
                                </a>

                                <form method="POST" action="{{ route('cart.update', ['product' => $product]) }}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group">
                                        <label class="label font-weight-bold" for="brand">Quantity</label>
                                        <select class="input form-control" name="amount" required>
                                            @for ($i = 1; $i <= $product->stock; $i++)
                                                <option value="{{ $i }}" {{ $i==$product->pivot->amount ? 'selected' : '' }} >
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="control">
                                            <button type="submit" class="btn btn-primary button is-link">Update</button>
                                        </div>
                                    </div>
                                </form>

                                <h5 class="font-weight-bold">€{{ $product->price }}</h5>
                            </div>

                            <div class="d-flex">
                                <a href="{{ route('cart.destroy', ['product' => $product]) }}" class="btn btn-danger">Remove from cart</a>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-12 my-4">
                        <div class="d-flex flex-column justify-content-center align-items-end">
                            <h3 class="mt-3 font-weight-bold">Total: €{{ $total }} </h3>
                            <div class="form-group mt-3">
                                <div class="control">
                                    <a href="{{ route('orders.create') }}" class="btn btn-success">Place order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 my-4">
                        <div class="d-flex justify-content-center align-items-center">
                            <h3>You have no products in cart!</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
