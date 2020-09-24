@extends('layouts.layout')

@section('content')
    <h1 class="mt-5">Categories</h1>

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
                <a href="{{ route('categories.index') }}" class="nav-link">Index</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('categories.create') }}" class="nav-link">Create</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('categories.delete', ['category' => $category->id]) }}" class="nav-link active">Delete category</a>
            </li>
        </ul>
    </nav>

    <form method="POST" action="{{ route('categories.update', ['category' => $category->id]) }}">
        @method('DELETE')
        @csrf

        <div class="form-group">
            <label for="name">Category name</label>
            <input type="text" name="name" class="form-control" id="name"
                   aria-describedby="categorienameHelp" placeholder="Enter category name"
                   value="{{ $category->name }}" disabled
            >
        </div>
        <button type="submit" class="btn btn-primary">Delete</button>
    </form>
@endsection
