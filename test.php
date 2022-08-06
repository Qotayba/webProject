<?php

include "adminheader.php";
?>
<link rel="stylesheet" href="test.css">
<body >
<section class="container-fluid adminMain ">
    <div    class=" container mt-5  d-flex justify-content-center main-div">

        <form action="admin.php" method="post" enctype="multipart/form-data" class="w-75 h-auto">
            <div class="mb-3 mt-3">
                <label for="barcode"><h3>Bar code:</h3></label>
                <input type="number" class="form-control" id="barcode" required placeholder="Enter bar code" name="barcode">
            </div>
            <div class="mb-3">
                <label for="Product-Name"><h3>Product name:</h3></label>
                <input type="text" class="form-control" id="Product-Name" placeholder="Enter Product Name" required  name="Product-name">
            </div>

            <div class="mb-3">
                <h3> This Product for</h3>
                <div class="row">
                    <div class="col-4">
                        <input type="radio" class="form-check-input" id="men" name="Product-for" required value="men" checked>
                        <label class="form-check-label" for="men">Men</label>
                    </div>

                    <div class="col-4">
                        <input type="radio" class="form-check-input" id="women" name="Product-for" required value="women" >
                        <label class="form-check-label" for="women">Women</label>
                    </div>

                    <div class="col-4">
                        <input type="radio" class="form-check-input" id="children" name="Product-for" required value="children" >
                        <label class="form-check-label" for="children">children</label>
                    </div>


                </div>

            </div>
            <div class="mb-3">
                <h3>Type of this Product</h3>
                <div class="row">
                    <div class="col">
                        <input type="radio" class="form-check-input" id="shoes" name="Product-type" required value="shoes" >
                        <label class="form-check-label" for="shoes">Shoes</label>
                    </div>
                    <div class="col">
                        <input type="radio" class="form-check-input" id="shirts" name="Product-type"  value="shirts" >
                        <label class="form-check-label" for="shirts">Shirts</label>
                    </div>
                    <div class="col">
                        <input type="radio" class="form-check-input" id="jeans" name="Product-type" value="jeans" >
                        <label class="form-check-label" for="jeans">Jeans</label>
                    </div>
                    <div class="col">
                        <input type="radio" class="form-check-input" id="suits" name="Product-type" value="suits" >
                        <label class="form-check-label" for="suits">Suits</label>
                    </div>
                </div>

            </div>
            <div class="mb-3">
                <label for="Product-Price"><h3>Product price:</h3></label>
                <input type="text" class="form-control" id="Product-price" placeholder="Enter Product price" required name="price">
            </div>
            <div class="mb-3">
                <label for="product-img"><h3>Product image:</h3></label>
                <input type="file" class="form-control" required accept="image/*" name="product-img">
            </div>
            <div class="mb-3 mt-3">
                <label for="quantity"><h3>Quntity:</h3></label>
                <input type="number" class="form-control" id="quantity" required placeholder="Enter quantity" name="quantity">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>
</body>