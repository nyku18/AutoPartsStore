@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(!$products->isEmpty())
                @foreach ($products as $product)
                    <div class="col-12 col-md-6 col-lg-4 my-4">
                          @if($product->photo)
                              <img class="card-img-top" src="{{ url('uploads/products') . '/' . $product->photo }}?v={{ time() }}" alt="Product photo">
                          @endif
                            <a href="{{ route('products.show', ['product' => $product]) }}">
                                <h3 class="card-title">{{ $product->title }}</h3>
                            </a>
                            <h5 class="font-weight-bold">€{{ $product->price }}</h5>
                            <form method="POST" action="{{ route('cart.update', ['product' => $product]) }}">
                              @method('PATCH')
                              @csrf
                              <div class="form-group">
                                <label class="label font-weight-bold" for="brand">Amount</label>
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
                            <a href="{{ route('cart.destroy', ['product' => $product]) }}" class="btn btn-primary">Remove from cart</a>
                        </div>
                @endforeach
                <div class="form-group">
                  <div class="control">
                    <a href="{{ route('orders.create') }}" class="btn btn-success">Place order</a>
                  </div>
                </div>
              @else
                <h3>You have no products in cart!</h3>
            @endif
        </div>
    </div>
@endsection
