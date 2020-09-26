@extends('layouts.layout')

@section('content')
    <h1 class="mt-5">Products</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <nav class="nav">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link">Index</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.create') }}" class="nav-link">Create</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.delete', ['product' => $product->id]) }}" class="nav-link active">Delete product</a>
            </li>
        </ul>
    </nav>

    <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}">
        @method('DELETE')
        @csrf

        <div class="form-group">
            <label for="name">Product name</label>
            <input type="text" name="name" class="form-control" id="name"
                   aria-describedby="productnameHelp" value="{{ $product->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="description">Product description</label>
            <textarea name="description" class="form-control" id="description"
                      rows="3" disabled>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Product price</label>
            <input type="text" name="price" class="form-control" id="price"
                   aria-describedby="productpriceHelp" value="{{ $product->get_latest_price->price  }}" disabled>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <input type="text" name="category_id" class="form-control" id="category_id"
                   aria-describedby="categoryidHelp" value="{{ $product->category->name  }}" disabled>
        </div>

        <button type="submit" class="btn btn-primary">Delete</button>
    </form>
@endsection
