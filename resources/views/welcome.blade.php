@extends('layout')

@section('content')

      <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">

              <h1 class="title">Products</h1>

              <ul>
                @foreach ($products as $product)
                  <li>
                    <a href="/products/{{ $product->id }}">
                      {{ $product->title}}
                    </a>

                    <a href="/cart" class="button is-link">
                      Add to cart
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
        </div>
@endsection
