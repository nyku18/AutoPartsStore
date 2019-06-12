@extends('layout')

@section('content')

<h1 class="title">Product details</h1>

<div class="field">
  <label class="label" for="user_id">Seller</label>

  <div class="control">
    <p class="input">{{ $product->user_id }}</p>
  </div>
</div>

<div class="field">
  <label class="label" for="brand">Brand</label>

  <div class="control">
    <p class="input">{{ $product->model->brand->name }}</p>
  </div>
</div>

<div class="field">
  <label class="label" for="model">Model</label>

  <div class="control">
    <p class="input">{{ $product->model->name }}</p>
  </div>
</div>

<div class="field">
  <label class="label" for="category">Category</label>

  <div class="control">
    <p class="input">{{ $product->category->title }}</p>
  </div>
</div>

<div class="field">
  <label class="label" for="title">Title</label>

  <div class="control">
    <p class="input">{{ $product->title}}</p>
  </div>
</div>

<div class="field">
  <label class="label" for="description">Description</label>

  <div class="control">
    <p class="textarea">{{ $product->description}}</p>
  </div>
</div>

<div class="field">
  <label class="label" for="title">Stock</label>

  <div class="control">
    <p class="input">{{ $product->stock }}</p>
  </div>
</div>

<div class="field">
  <label class="label" for="title">Price</label>

  <div class="control">
    <p class="input">{{ $product->price }}</p>
  </div>
</div>

<div class="field">
      <p class="checkbox">{{ $product->original ? 'Original' : 'Unoriginal' }}</p>
</div>

<div class="field">
  <label class="label" for="photo">Photo</label>
  <div class="control">
    <p class="input">{{ $product->photo }}</p>
  </div>
</div>

@if(Auth::user()->id == $product->user_id)
  <div class="field">
    <div class="control">
      <a href="{{ route('products.edit', ['product' => $product]) }}" class="button is-link">
        Settings
      </a>
    </div>
  </div>

@else
  <div class="field">
    <div class="control">
      <a href="/cart" class="button is-link">
        Add to cart
      </a>
    </div>
  </div>
@endif

@endsection
