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
                </tr>
                <form method="post" action="{{route('product.create')}}">
                        @csrf 
                        @method('get')
                        <input type="submit" value="Create New" />
                </form>
            </thead>
            <tbody>
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
