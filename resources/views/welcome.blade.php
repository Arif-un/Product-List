<!doctype html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">


    </head>

    <body class="jumbotron">

        <h1 style="text-align:center">
            <b>Product List</h1>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 jumbotron">
                <form id="" action="{{url('/product')}}" method="POST">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="product">Product Name</label>
                        <input type="text" class="form-control" id="pd-name" name="name" placeholder="Product Name">
                    </div>

                    <div class="form-group">
                        <label for="product">Quantity in stock</label>
                        <input type="number" class="form-control" id="stock" name="quantity-in-stock" placeholder="Quantity">
                    </div>

                    <div class="form-group">
                        <label for="product">Price per item</label>
                        <input type="number" class="form-control" id="price" name="price-per-item" placeholder="$$$">
                    </div>

                    <div class="form-group">
                        <input class="btn btn-lg btn-primary" type="button" value="Save" name="submit" onclick='insert()' />
                    </div>

                </form>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table id="tab" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>DateTime Submitted</th>
                            <th>Total Value Number</th>
                            <th>Total Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $value) { ?>
                        <tr>
                            <td>
                                <?= $value->product_name ?>
                            </td>
                            <td>
                                <?= $value->stock ?>
                            </td>
                            <td>
                                <?= $value->price ?>
                            </td>
                            <td>
                                <?= $value->created_at ?>
                            </td>
                            <td>
                                <?= $value->stock . " x " . $value->price ?>
                            </td>
                            <td>
                                <?= $value->stock * $value->price ?>
                            </td>
                            <td>
                                <button class="btn">✎</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
            <div class="col-md-1"></div>
        </div>

        <script
        src=" https://code.jquery.com/jquery-3.1.1.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>


        <script>

                        function insert() {
                            let pdt_name = $('#pd-name').val();
                            let stock = $('#stock').val();
                            let price = $('#price').val();

                            let data = {
                                "product_name": pdt_name,
                                "stock": stock,
                                "price": price
                            }

                            $.ajax({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                url: "/product",
                                type: 'POST',
                                data: data,
                                success: function (msg) {
                                        $('#tab').append(`<tr>
                                        <td>${msg.product_name}</td>
                                        <td>${msg.stock}</td>
                                        <td>${msg.price}</td>
                                        <td>${msg.created_at}</td>
                                        <td>${msg.stock} x ${msg.price}</td>
                                        <td>${msg.stock*msg.price}</td>
                                        <td><button class="btn">✎</button></td>
                                        </tr>`); 
                                }
                            })
                        }
        </script>

    </body>

</html>