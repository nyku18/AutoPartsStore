@extends('layout')

@section('content')

  <h1 class="title">Products</h1>

  <ul>
    @foreach ($products as $product)
      <li>
        <a href="{{ route('products.show', ['product' => $product]) }}">
          {{ $product->title}}
        </a>
      </li>
    @endforeach
  </ul>
  
  <a href="{{ route('products.create') }}" class="button is-link">
    Add product
  </a>
@endsection
