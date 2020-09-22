@extends('layouts.layout')

@section('content')
    <h1 class="mt-5">Categories</h1>

    <nav class="nav">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link">Index</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('categories.create') }}" class="nav-link active">Create</a>
            </li>
        </ul>
    </nav>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Category name</label>
            <input type="text" name="name" class="form-control" id="name"
                   aria-describedby="categorienameHelp" placeholder="Enter category name">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
