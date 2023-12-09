<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>

    <style>
        body {
                font-family: Arial, Helvetica, sans-serif;
                margin: 0;
                width: 100%;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
            }

            a {
                text-decoration: none;
                color: black;
            }

            .form-product {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 80%;
            }

            table {
                text-align: center;
                padding: 1rem;
                width: 100%;
            }

            th, td {
                gap: 1rem;
                padding: 1rem;
                background-color: rgb(222, 222, 222);
            }

            td:last-child {
                display: flex;
                gap: 1rem;
                padding: 1rem;
                align-items: center;
                justify-content: center;
            }

            .delete {
                color: red;
                margin: 0;
                padding: 0;
                background: none;
                font-size: 16px;
                border: none;
                cursor: pointer;
            }

            input {
                padding: 1rem;
                border: 1px solid rgb(201, 201, 201);
            }

            .create {
                display: none;
                width: 100%;
            }

            #ch {
                display: none;
            }

            #ch:checked ~ .create {
                display: flex;
                justify-content: center;
            }

            .form-create {
                display: flex;
                gap: 1rem;
            }
    </style>

</head>
<body>
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <br>
    <div class="form-product">
        <input type="checkbox" id="ch">
        <div>
            <label for="ch" class="button">
                <span>+ Tambah Product</span>
            </label>
        </div>
        <br>
        <br>
        <div class="create">
            <form class="form-create" method="post" action="{{route('product.store')}}">
                @csrf 
                @method('post')
                <div>
                    <input type="text" name="name" placeholder="Nama" />
                </div>
                <div>
                    <input type="text" name="price" placeholder="Harga" />
                </div>
                <div>
                    <input type="text" name="description" placeholder="Deskripsi" />
                </div>
                <div>
                    <input type="submit" value="Save a New Product" />
                </div>
            </form>
        </div>

        <br>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
            @foreach($products as $product )
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->description}}</td>
                    <td>
                        <div>
                            <a href="{{route('product.edit', ['product' => $product])}}">Edit</a>
                        </div>
                        <form method="post" action="{{route('product.destroy', ['product' => $product])}}">
                            @csrf 
                            @method('delete')
                            <button class="delete" type="submit" value="Delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>