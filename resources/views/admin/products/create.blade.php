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
                <a href="{{ route('products.create') }}" class="nav-link active">Create</a>
            </li>
        </ul>
    </nav>

    <form method="POST" action="{{ route('products.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Product name</label>
            <input type="text" name="name" class="form-control" id="name"
                   aria-describedby="productnameHelp" value="{{ old('name') }}" placeholder="Enter product name">
        </div>

        <div class="form-group">
            <label for="description">Product description</label>
            <textarea name="description" class="form-control" id="description"
                      rows="3" placeholder="Enter product description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Product price</label>
            <input type="text" name="price" class="form-control" id="price"
                   aria-describedby="productpriceHelp" value="{{ old('price') }}" placeholder="Enter product price">
        </div>

        <div class="form-group">
            <label for="category_id">Select category</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @if(old('category_id') == $category->id)
                            selected
                        @endif
                    >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
