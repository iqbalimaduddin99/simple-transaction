<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="table-responsive">
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Description</strong></th>
                    <th><strong>Photo</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>qty</strong></th>
                </tr>
                @if($role == 'admin')
                    <form method="post" action="{{route('product.create')}}">
                            @csrf 
                            @method('get')
                            <input type="submit" value="Create New Product" />
                    </form>
                @else
                    <form method="get" action="{{route('transaction.index')}}">
                        @csrf 
                        @method('get')
                        <input type="submit" value="Create Transaction" />
                    </form>
                @endif
            </thead>
            <tbody>
                @foreach($transaction->transactionProducts as $product )
                        <tr>
                            <td>{{$product->product->product_name}}</td>
                            <td>{{$product->product->desc}}</td>
                            <td>{{$product->product->photo_url}}</td>
                            <td>{{$product->product->price}}</td>
                            <td>{{$product->qty}}</td>
                        </tr>
                @endforeach

            </tbody>
        </table>
        <div class="mt-3 space-y-1">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
    
</body>
</html>
