@extends('app')

@section('content')
        <div class="row mx-auto my-5">

        @foreach ($products as $product)  
        <div class="col-md-3 my-2">
            <div class="card">
                <img class="card-img-top" src="https://via.placeholder.com/150C/O https://placeholder.com/" alt="Card image cap">
                <div class="card-body py-2" style="height: 150px">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text" style="font-size: 15px">{{ Str::limit($product->description, 50) }}.</p>
                    <a href="{{ route('cart.add', $product) }}" class="btn btn-secondary"><i class="fas fa-shopping-cart"></i> Add to cart</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection