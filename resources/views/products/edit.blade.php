@extends('layout')

@section('content')

  <h1 class="title">Edit product</h1>

  <form method="POST" action="/products/{{ $product->id }}" enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

    @if($brands)
      <label class="label" for="brand">Brand</label>
      <select class="input" name="brand_id" required>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" {{ ($brand->id == $product->model->brand->id) ? "selected" : "" }}>{{ $brand->name }}</option>
        @endforeach
      </select>
    @endif

    @if($models)
      <label class="label" for="model">Model</label>
      <select class="input" name="model_id" required>
        @foreach($models as $model)
            <option value="{{ $model->id }}" {{ ($model->id == $product->model->id) ? "selected" : "" }}>{{ $model->name }}</option>
        @endforeach
      </select>
    @endif

    @if($categories)
      <label class="label" for="categorie">Category</label>
      <select class="input" name="category_id" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ ($category->id == $product->category->id) ? "selected" : "" }}>{{ $category->title }}</option>
        @endforeach
      </select>
    @endif

    <div class="field">
      <label class="label" for="title">Title</label>

      <div class="control">
        <input type="text" class="input" name="title" placeholder="Title" value="{{ $product->title }}" required>
      </div>
    </div>

    <div class="field">
      <label class="label" for="description">Description</label>

      <div class="control">
        <textarea name="description" class="textarea" placeholder="Description" required>{{ $product->description }}</textarea>
      </div>
    </div>

    <div class="field">
      <label class="label" for="title">Stock</label>

      <div class="control">
        <input type="number" class="input" name="stock" placeholder="Stock" value="{{ $product->stock }}" min="0" required>
      </div>
    </div>

    <div class="field">
      <label class="label" for="title">Price</label>

      <div class="control">
        <input type="decimal" class="input" name="price" placeholder="Price" value="{{ $product->price }}" min="0" required>
      </div>
    </div>

    <div class="field">
      <label class="checkbox" for="original">
            <input type="checkbox" name="original" value="1" {{ ($product->original == 1) ? "checked" : "" }}>
              Original
          </label>
    </div>

    <div class="field">
      <label class="label" for="photo">Photo</label>

      <div class="control">
        <input type="file" class="input" name="product_photo" value="{{ $product->photo }}" required>
      </div>
    </div>

    <div class="field">
      <div class="control">
        <button type="submit" class="button is-link">Update product</button>
      </div>
    </div>

    @include ('errors')
  </form>

  <form method="POST" action="/products/{{ $product->id }}">
    @method('DELETE')
    @csrf

    <div class="field">
      <div class="control">
        <button type="submit" class="button is-link">Delete product</button>
      </div>
    </div>
  </form>
@endsection
