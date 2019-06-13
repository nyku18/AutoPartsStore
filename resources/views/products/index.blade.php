@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-secondary text-white">All products</div>

          <div class="card-body">
            <ul class="list-group list-group-flush">
              @foreach ($products as $product)
                <li class="list-group-item">
                  <a href="{{ route('products.show', ['product' => $product]) }}">
                    {{ $product->title}}
                  </a>
                </li>
              @endforeach
            </ul>

            <a href="{{ route('products.create') }}" class="btn btn-primary button is-link mt-4">
              Add product
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
