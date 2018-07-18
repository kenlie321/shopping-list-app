<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <h3 class="text-left">My Shopping List</h3>
        <div class="col-sm-8 col-sm-offset-2">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <td>Stuff to Buy</td>
                        <td>Price (Estimated)</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            foreach($list as $key => $val){
                                for($i = 0; $i < count($val); $i++){
                                    echo "<td>{$val[$i]}</td>";
                                }
                            }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <form action="/add/product" method="post" class="form-inline">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
            <div>
                Product: <input class="form-control" type="text" name="product" id="product">
            </div>
            <div>
                Price: <input class="form-control" type="number" name="price" id="price">
            </div>
            <div style="margin-left:10px">
                <input type="submit" name="add" value="Add" class="form-control btn btn-success">
            </div>
        </form>
        <div class="container-fluid">
            <h3 style="margin:10px" class="text-left">Total Price: 3$</h3>
        </div>
    </div>
</body>
</html>