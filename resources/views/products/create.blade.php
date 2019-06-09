@extends('layout')

@section('content')

  <h1 class="title">Add a new product</h1>

  <form method="POST" action="/products">
    @csrf

    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

    @if($brands)
      <label class="label" for="brand">Brand</label>
      <select class="input" name="brand_id" required>
        <option></option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
        @endforeach
      </select>
    @endif

    @if($models)
      <label class="label" for="model">Model</label>
      <select class="input" name="model_id" required>
        <option></option>
        @foreach($models as $model)
            <option value="{{ $model->id }}">{{ $model->name }}</option>
        @endforeach
      </select>
    @endif

    @if($categories)
      <label class="label" for="category">Category</label>
      <select class="input" name="category_id" required>
        <option></option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
      </select>
    @endif

    <div class="field">
      <label class="label" for="title">Title</label>

      <div class="control">
        <input type="text" class="input" name="title" placeholder="Title" value="{{ old('title')}}" required>
      </div>
    </div>

    <div class="field">
      <label class="label" for="description">Description</label>

      <div class="control">
        <textarea name="description" class="textarea" placeholder="Description" required>{{ old('description') }}</textarea>
      </div>
    </div>

    <div class="field">
      <label class="label" for="title">Stock</label>

      <div class="control">
        <input type="number" class="input" name="stock" placeholder="Stock" min="0" required>
      </div>
    </div>

    <div class="field">
      <label class="label" for="title">Price</label>

      <div class="control">
        <input type="decimal" class="input" name="price" placeholder="Price" min="0" required>
      </div>
    </div>

    <div class="field">
      <label class="checkbox" for="original">
            <input type="checkbox" name="original" value="1">
              Original
          </label>
    </div>

    <div class="field">
      <label class="label" for="photo">Photo</label>

      <div class="control">
        <input type="file" class="input" name="photo" required>
      </div>
    </div>

    <div class="field">
      <div class="control">
        <button type="submit" class="button is-link">Add product</button>
      </div>
    </div>

    @include ('errors')
  </form>
@endsection
