<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            flex-direction:column;
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
        
        .form-container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.2rem;
        }

        .mt-rem {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group input[type="text"] {
            padding: 0.6rem 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="text"]:focus {
            border-color: #ff7f00;
            outline: none;
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
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>


        @endif
    </div>
    
<div class="form-container">
    <form class="mt-rem"  method="get" action="{{route('product.index')}}">
        @csrf 
        @method('get')
        <input class="button" type="submit" value="List Product" />
    </form>
    <form method="post" action="{{route('product.update', ['product' => $product])}}">
        @csrf 
        @method('put')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="product_name" placeholder="Name" value="{{ old('product_name', $product->product_name) }}" />
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" name="price" placeholder="Price" value="{{ old('price', $product->price) }}" />
        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" name="desc" placeholder="Description" value="{{ old('desc', $product->desc) }}"/>
        </div>
        <div style="text-align: right;">
            <input class="button" type="submit" value="Update" />
        </div>
    </form>
</div>
    
</div>
</body>
</html>