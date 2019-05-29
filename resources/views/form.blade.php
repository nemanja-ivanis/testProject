<!doctype html>
<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Form Test</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-2">

        </div>
        <div class="col-lg-8">

            <h2>TEST FORM</h2>
            <form method="post" action="/add-product">

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif

                {{csrf_field()}}
                <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" class="form-control" id="product_name" value="{{ old('product_name') }}" required>
                    @if($errors->has('product_name'))
                        <span class="help-block">{{ $errors->first('product_name') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                    <label for="quantity">Quantity in stock</label>
                    <input type="number"  name="quantity" class="form-control" id="quantity" value="{{ old('quantity') }}" required>
                    @if($errors->has('quantity'))
                        <span class="help-block">{{ $errors->first('quantity') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price">Price per item</label>
                    <input type="number" step="any" name="price" class="form-control" id="quantity" value="{{ old('price') }}" required>
                    @if($errors->has('price'))
                        <span class="help-block">{{ $errors->first('quantity') }}</span>
                    @endif
                </div>

                 <button type="submit" class="btn btn-default">Submit</button>

            </form>
            @if(Session::has('status'))
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">×</a>
                    {{Session::get('status')}}
                </div>
            @endif
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th><th>Quantity in stock</th><th>Price per item</th><th>Datetime submitted</th><th>Total value number</th><th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item['product_name']}}</td><td>{{$item['quantity']}}</td><td>{{$item['price']}}</td><td>{{\Carbon\Carbon::parse($item['date_added'])->format('d/m/Y H:i:s')}}</td><td>{{$item['quantity']*$item['price']}}</td><td><button id="{{$item['product_name']}}" class="edit">Edit</button></td>
                    </tr>

                @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td>SUM:</td><td></td><td></td><td></td><td>{{$sum}}</td>
                    </tr>
                </tfoot>
            </table>




        </div>
        <div class="col-lg-2">

        </div>
    </div>
</div>
</body>
<script>



</script>

</html>