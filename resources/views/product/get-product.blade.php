<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>

        .navbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background: linear-gradient(135deg, #ff7f00, #ffcc00);
            padding: 1rem 2rem;
            position: relative;
            color: white;
        }


        .nav-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #333;
        }

        .nav-toggle {
            display: none;
        }

        .nav-toggle-label {
            font-size: 1.8rem;
            display: none;
            cursor: pointer;
            user-select: none;
        }


        .button {
            display: inline-block;
            background: linear-gradient(135deg, #ff7f00, #ffcc00);
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            cursor: pointer;
            background: linear-gradient(135deg, #ffcc00, #ff7f00);
        }

        
        th {
            background: linear-gradient(135deg, #ff7f00, #ffcc00);
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            width: 20%; 
            text-align:start;
        }

        .cursor-pointer {
            cursor: pointer;
        }
        
        .card {
            min-width: 30%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
            background-color: #f0f0f0; 
        }

        td {
            padding-left:10px;
            border-width: 2px;
            border-color: #ffcc00;
            text-align:start;
            min-width: 10em; 
            white-space: nowrap;
            width: 20%; 
            text-align:start;
        }

        .border-none {
            border: none !important;
            border-image: none !important;
        }
        
        .max-w {
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        @media (min-width: 640px) {
            .table-responsive {
                width: 70%;
            }
        }

        @media (min-width: 768px) {
            .table-responsive {
                width: 70%;
            }
        }


        @media (max-width: 768px) {
        .nav-links {
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #ff7f00, #ffcc00);
            display: none;
            padding: 1rem 0;
        }

        .nav-links li {
            text-align: center;
            padding: 0.5rem 0;
        }

        .nav-toggle:checked + .nav-toggle-label + .nav-links {
            display: flex;
        }

        .nav-toggle-label {
            display: block;
        }
    }

    </style>
</head>
<body>
<nav class="navbar">
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="nav-toggle-label">
        ☰
    </label>
    
    <ul class="nav-links">
        <li>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); this.closest('form').submit();"
                style="cursor: pointer; text-decoration: none; color: inherit;">
                    {{ __('Log Out') }}
                </a>
            </form>
        </li>
    </ul>
    
</nav>
<div class="container">
    <div class="table-responsive card py-6 px-6 w-full">
        <table class="mt-3 space-y-1">
            <thead>
                <tr>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Description</strong></th>
                    <th><strong>Photo</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Qty</strong></th>
                    <th><strong>Sub Total</strong></th>
                </tr>
                @if($role == 'admin')
                    <form method="post" action="{{route('product.index')}}">
                            @csrf 
                            @method('get')
                            <input class="button" type="submit" value="List Product" />
                    </form>
                @else
                    <form method="get" action="{{route('transaction.index')}}">
                        @csrf 
                        @method('get')
                        <input class="button"  type="submit" value="List Transaction" />
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
                            <td>{{$product->total_price}}</td>
                        </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
    
</body>
</html>
