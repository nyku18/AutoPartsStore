@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Add product</div>

          <div class="card-body">
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
              @csrf

              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

              <div class="form-group">
                <label class="label" for="photo">Photo</label>

                <div class="control">
                  <input type="file" class="input" name="product_photo" required>
                </div>
              </div>

              <div class="form-group">
                <label class="label" for="title">Title</label>

                <div class="control">
                  <input type="text" class="input form-control" name="title" placeholder="Title" value="{{ old('title')}}" required>
                </div>
              </div>

              <div class="form-group">
                <label class="label" for="description">Description</label>

                <div class="control">
                  <textarea name="description" class="textarea form-control" placeholder="Description" required>{{ old('description') }}</textarea>
                </div>
              </div>

              @if($brands)
                <div class="form-group">
                  <label class="label" for="brand">Brand</label>
                  <select class="input form-control" name="brand_id" required>
                    <option></option>
                    @foreach($brands as $brand)
                      <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                  </select>
                </div>
              @endif

              @if($models)
                <div class="form-group">
                  <label class="label" for="model">Model</label>
                  <select class="input form-control" name="model_id" required>
                    <option></option>
                    @foreach($models as $model)
                      <option value="{{ $model->id }}">{{ $model->name }}</option>
                    @endforeach
                  </select>
                </div>
              @endif

              @if($categories)
                <div class="form-group">
                  <label class="label" for="category">Category</label>
                  <select class="input form-control" name="category_id" required>
                    <option></option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                  </select>
                </div>
              @endif

              <div class="form-group">
                <label class="label" for="title">Stock</label>

                <div class="control">
                  <input type="number" class="input form-control" name="stock" placeholder="Stock" min="0" required>
                </div>
              </div>

              <div class="form-group">
                <label class="label" for="title">Price ($)</label>

                <div class="control">
                  <input type="decimal" class="input form-control" name="price" placeholder="Price" min="0" required>
                </div>
              </div>

              <div class="form-check">
                <input type="checkbox" name="original" value="1" class="form-check-input">
                <label class="checkbox" for="original">Original</label>
              </div>

              <div class="form-group">
                <div class="control">
                  <button type="submit" class="btn btn-primary button is-link">Add product</button>
                </div>
              </div>

              @include ('errors')
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
