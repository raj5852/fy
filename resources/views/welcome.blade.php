<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <div style="border: 1px solid black; padding:15px">
            <h2>Products Input</h2>
            <form action="{{ route('store') }}" method="POST">
                @csrf
                <label for="">Product</label>
                : <select class="form-control" name="alldata" id="">
                    <option value="packagingpaper">Packaging Paper</option>
                    <option value="teshupaper">Teshu Paper</option>
                    <option value="newspaper">News Paper</option>
                </select>
                Size :<input class="form-control" type="number" name="inch" placeholder="Inch">
                Weight : <input class="form-control" type="number" name="kg" placeholder="KG"> <br>

                <input type="submit" value="Save" class="btn btn-success">
            </form>
        </div>
        <hr>

        <div style="border: 1px solid black; padding:15px">
            <h2>Stock</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Weight</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produts as $product)
                    <tr>
                        <td> {{ $product->id }} </td>
                        <td> {{ $product->productid }} </td>
                        <td> {{ $product->productname }} </td>
                        <td> {{ $product->size }} </td>
                        <td> {{ $product->weight}} </td>
                        <td> {{ $product->created_at}} </td>
                    </tr>

                    @endforeach
                </tbody>

            </table>

        </div><br>
        <div class="row" style="border: 1px solid black; padding:15px">
            <div class="card card-body col-md-6">
                <h2>Producs Delivery </h2>
                <form action="delivery" method="post">
                    @csrf
                    <input id="array_store" type="hidden" name="array_store[]" >
                    Customer : <select class="form-control" name="customerName" id="">
                        <option value="Rahim">Rahim</option>
                        <option value="Kabir">Kabir</option>
                        <option value="Polas">Polas</option>
                    </select>
                    <table class="table table-bordered">
                        <thead>
                            <th>Product id</th>
                            <th>Scan</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="datappend">

                        </tbody>
                    </table><br>
                    <button type="button" class="btn btn-success">Save & Print</button>
                </form>

            </div>
            <div class="card card-body col-md-6">
                <h2>Prodict list</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produts as $ps)
                        <tr>
                            <td> {{ $ps->productname }} </td>
                            <td> <button value="{{ $ps->id }}" class="btn btn-success demo">Add</button> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>




    </div>




</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('.demo').click(function() {
            var id = $(this).val();
            
            var dataArray = [];
            $.ajax({
                url: '/ajax',
                method: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#datappend').append('<tr><td>'+data.data.productid+'</td><td>'+data.data.barcode+'</td><td><button type="button" class="btn btn-danger btn-sm">Delete</button></td></tr>')
                    dataArray.push(data.data.productid)
                    console.log(dataArray)
                }
            })
        })
    })
</script>