@extends('layout')

@section('content')

  <h1 class="title">Products</h1>

  <ul>
    @foreach ($products as $product)
      <li>
        <a href="/products/{{ $product->id }}">
          {{ $product->title}}
        </a>
      </li>
    @endforeach
  </ul>
  
  <a href="/products/create" class="button is-link">
    Add product
  </a>
@endsection
