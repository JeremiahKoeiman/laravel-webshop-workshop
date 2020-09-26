@extends('layouts.layout')

@section('content')
    <h1 class="mt-5">Products</h1>

    <nav class="nav">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link">Index</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.create') }}" class="nav-link ">Create</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.show', ['product' => $product->id]) }}" class="nav-link active">Product details</a>
            </li>
        </ul>
    </nav>

    <div class="card">
        <div class="card-header">
            Product
        </div>
        <div class="card-body">
            <h2 class="card-title">{{ $product->name }}</h2>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text">Category: {{ $product->category->name }}</p>
            <h3 class="card-text text-primary font-weight-bold">Current price: € {{ $product->get_latest_price->price }}</h3>
            <br>
            <div style="background-color:#888888; ">
                <h1 class="text-primary">Previous prices in card style</h1>
                <div class="card">
                    <h5 class="card-header">Previous prices:</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($product->price as $price)
                            @if($product->get_latest_price->price != $price->price)
                                <li class="list-group-item">Id: {{ $price->id }}, Price: <span class="font-weight-bold">€ {{ $price->price }}</span>, effective date: <span class="font-weight-bold">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $price->effdate) }}</span></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <br>
            <br>

            <div style="background-color:#bcbcbc; ">
                <h1 class="text-secondary">Previous prices in table style</h1>
                <p class="card-text">Prices: </p>
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Price</th>
                        <th scope="col">Effective date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($product->price->sortByDesc('effdate') as $item)
                            <tr>
                                <td scope="row">{{ $item->id }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->effdate }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
