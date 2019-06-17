@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-secondary text-white">Edit product</div>

        <div class="card-body">

          <form method="POST" action="{{ route('products.update', ['product' => $product]) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="photo" value="{{ $product->photo }}">

            @if($product->photo)
              <div class="form-group">
                <img src="{{ url('uploads/products') . '/' . $product->photo }}?v={{ time() }}" alt="Product photo">
              </div>
            @endif

            <div class="form-group">
              <label class="label font-weight-bold" for="photo">Photo</label>

              <div class="control">
                <input type="file" class="input" name="product_photo">
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="title">Title</label>

              <div class="control">
                <input type="text" class="input form-control" name="title" placeholder="Title" value="{{ $product->title }}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="description">Description</label>

              <div class="control">
                <textarea name="description" class="textarea form-control" placeholder="Description" required>{{ $product->description }}</textarea>
              </div>
            </div>

            @if($brands)
              <div class="form-group">
                <label class="label font-weight-bold" for="brand">Brand</label>
                <select class="input form-control" name="brand_id" required>
                  @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ ($brand->id == $product->model->brand->id) ? "selected" : "" }}>{{ $brand->name }}</option>
                  @endforeach
                </select>
              </div>
            @endif

            @if($models)
              <div class="form-group">
                <label class="label font-weight-bold" for="model">Model</label>
                <select class="input form-control" name="model_id" required>
                  @foreach($models as $model)
                    <option value="{{ $model->id }}" {{ ($model->id == $product->model->id) ? "selected" : "" }}>{{ $model->name }}</option>
                  @endforeach
                </select>
              </div>
            @endif

            @if($categories)
              <div class="form-group">
                <label class="label font-weight-bold" for="categorie">Category</label>
                <select class="input form-control" name="category_id" required>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == $product->category->id) ? "selected" : "" }}>{{ $category->title }}</option>
                  @endforeach
                </select>
              </div>
            @endif

            <div class="form-group">
              <label class="label font-weight-bold" for="title">Stock</label>

              <div class="control">
                <input type="number" class="input form-control" name="stock" placeholder="Stock" value="{{ $product->stock }}" min="0" required>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="title">Price (€)</label>

              <div class="control">
                <input type="decimal" class="input form-control" name="price" placeholder="Price" value="{{ $product->price }}" min="0" required>
              </div>
            </div>

            <div class="form-check">
              <input type="checkbox" name="original" value="1" {{ ($product->original == 1) ? "checked" : "" }} class="form-check-input">
              <label class="checkbox" for="original">Original</label>
            </div>

            <div class="form-group">
              <div class="control">
                <button type="submit" class="btn btn-primary button is-link">Update product</button>
              </div>
            </div>

          </form>
          @include ('errors')
          <form method="POST" action="{{ route('products.destroy', ['product' => $product]) }}">
            @method('DELETE')
            @csrf

            <div class="form-group">
              <div class="control">
                <button type="submit" class="btn btn-danger button is-link">Delete product</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
