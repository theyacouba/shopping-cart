@extends('app')

@section('content')
    <h1 class="my-3 text-center">Your cart</h1>
    
    @if (count($carts) > 0)
        <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th class="col-md-1">Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            <tr>
                    <td>{{ $cart['product']->title }}</td>
                    <td>{{ $cart['product']->price }}</td>
                    <td>
                        <form action="{{ route('cart.update', $cart['product']) }}" method="post">
                            @csrf
                            <input name="quantity" class="form-control form-control-sm text-center" type="number" value="{{ $cart['quantity'] }}">
                        </form>
                    </td>
                    <td>{{ $cart['quantity'] * $cart['product']->price }}</td>
                    <td><a href="{{ route('cart.remove', $cart['product']) }}" class="text-secondary btn-sm"><i class="fas fa-trash"></i></a></td>
                </tr>
                @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total price</td>
                <td>{{ $totalPrice }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    @else
        <p class="text-center my-5">Your cart is empty !</p>
    @endif

@endsection