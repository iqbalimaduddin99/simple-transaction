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
                    <th><strong>Transactoin ID</strong></th>
                    <th><strong>Total Price</strong></th>
                    <th><strong>Customer Name</strong></th>
                </tr>
                <form method="get" action="{{route('product.index')}}">
                    @csrf 
                    @method('get')
                    
                    @if($role == 'admin')
                    <input type="submit" value="Create Product" />
                    @else
                    <input type="submit" value="Create Transaction" />
                    @endif
                </form>
            </thead>
            <tbody>
                @foreach($transactions as $transaction )
                    <tr>
                        <td>{{$transaction->id}}</td>
                        <td>{{$transaction->total_price ?? '-'}}</td>
                        <td>{{$transaction->user->name }}</td>
                        <td>
                            <form method="get" action="{{route('product-transaction.index', ['transaction' => $transaction])}}">
                                @csrf 
                                @method('get')
                                <input type="submit" value="Get Detail Transaction" />
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
