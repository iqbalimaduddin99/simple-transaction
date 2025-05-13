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
            width: auto !important;  
            min-width: 0 !important;     
            border: none !important;
            border-image: none !important;
        }
        
        .padding-right-20 {   
            padding-right: 20px !important;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        input[type="number"] {
            border: none;
            outline: none;
            width: 3em;
            text-align: center;
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-control { 
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.5em;
        }

        .qty-btn {
            background: #ff7f00;
            border: none;
            color: white;
            font-weight: bold;
            padding: 0.3em 0.6em;
            border-radius: 4px;
            cursor: pointer;
        }

        .qty-btn:hover {
            background: #e66a00;
        }

        .padding-0{
            padding-left:0;
        }

        .button-row {
            display: flex;
            gap: 1rem; 
            margin-top: 1rem;
        }

        .button-row form {
            margin: 0;
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
    <script>
         function increaseQty(id) {
            const qtyInput = document.getElementById(`qty-${id}`);
            qtyInput.value = parseInt(qtyInput.value) + 1;
            updateTotal(id);
        }

        function decreaseQty(id) {
            const qtyInput = document.getElementById(`qty-${id}`);
            if (parseInt(qtyInput.value) > 0) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
                updateTotal(id);
            }
        }

        function updateTotal(id) {
            const price = parseFloat(document.getElementById(`price-${id}`).textContent);
            const qty = parseInt(document.getElementById(`qty-${id}`).value);
            const total = price * qty;
            document.getElementById(`total-${id}`).textContent = total.toLocaleString();
        }
    </script>
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
            @if($role == 'admin')
                <div class="button-row">
                    <form method="post" action="{{route('product.create')}}">
                        @csrf 
                        @method('get')
                        <input class="button" type="submit" value="Create New Product" />
                    </form>
                    <form method="post" action="{{route('transaction.index')}}">
                        @csrf 
                        @method('get')
                        <input class="button" type="submit" value="List Transaction" />
                    </form>
                </div>
            @else
                <form method="get" action="{{route('transaction.index')}}">
                    @csrf 
                    @method('get')
                    <input class="button"  type="submit" value="List Transaction" />
                </form>
            @endif
        <form method="POST" action="{{ route('transaction.store') }}">
            <table class="mt-3 space-y-1">
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
                </thead>
                <tbody>
                    @if($role == 'admin')
                        @foreach($products as $product )
                            <tr>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->desc}}</td>
                                <td>{{$product->photo_url}}</td>
                                <td>{{$product->price}}</td>
                                <td class="border-none">
                                    <a class="button"  href="{{route('product.edit', ['product' => $product])}}">Edit</a>
                                </td>
                                <td class="border-none padding-right-20">
                                    <form method="post" action="{{route('product.destroy', ['product' => $product])}}">
                                        @csrf 
                                        @method('DELETE')
                                        <input class="button" type="submit" value="Delete" />
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @csrf
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->desc}}</td>
                                    <td>{{$product->photo_url}}</td>
                                    <td id="price-{{ $product->id }}">{{$product->price}}</td>
                                    <td class="px-2">
                                        <div class="quantity-control">
                                            <button type="button" class="qty-btn" onclick="decreaseQty({{ $product->id }})">-</button>
                                            <input type="number" name="quantities[{{ $product->id }}]" id="qty-{{ $product->id }}" value="0" min="0" oninput="updateTotal({{ $product->id }})">
                                            <button type="button" class="qty-btn" onclick="increaseQty({{ $product->id }})">+</button>
                                        </div>
                                    </td>
                                    <td><span id="total-{{ $product->id }}">0</span></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>        
                </table>
            @if($role != 'admin')
            <button class="mt-3 button"  type="submit">Create Transaction</button>
            @endif
        </form>
    </div>
</div>
</body>
</html>
