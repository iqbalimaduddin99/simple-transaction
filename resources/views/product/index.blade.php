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
                    @if($role == 'guests')
                    <th><strong>qty</strong></th>
                    <th><strong>total</strong></th>
                    @endif
                </tr>
                @if($role == 'admin')
                    <form method="post" action="{{route('product.create')}}">
                            @csrf 
                            @method('get')
                            <input type="submit" value="Create New Product" />
                    </form>
                    <form method="post" action="{{route('transaction.index')}}">
                            @csrf 
                            @method('get')
                            <input type="submit" value="List Transaction" />
                    </form>
                @else
                    <form method="get" action="{{route('transaction.index')}}">
                        @csrf 
                        @method('get')
                        <input type="submit" value="List Transaction" />
                    </form>
                @endif
            </thead>
            <tbody>
                @if($role == 'admin')
                    @foreach($products as $product )
                        <tr>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->desc}}</td>
                            <td>{{$product->photo_url}}</td>
                            <td>{{$product->price}}</td>
                                <td>
                                    <a href="{{route('product.edit', ['product' => $product])}}">Edit</a>
                                </td>
                                <td>
                                    <form method="post" action="{{route('product.destroy', ['product' => $product])}}">
                                        @csrf 
                                        @method('delete')
                                        <input type="submit" value="Delete" />
                                    </form>
                                </td>
                        </tr>
                    @endforeach
                
                @else
                    <form method="POST" action="{{ route('transaction.store') }}">
                        @csrf
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->desc}}</td>
                                    <td>{{$product->photo_url}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        <input type="number" name="quantities[{{ $product->id }}]" value="0" min="0">
                                    </td>
                                </tr>
                            @endforeach
                        <button type="submit">Buat Transaksi</button>
                    </form>
                @endif
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
