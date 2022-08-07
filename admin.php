<?php

include "logincheck.php";
if (!isset($_SESSION['user-is-admin'])){
    header("location: index.php");
    exit();
}

$flagCanInsert=false;

if (isset($_POST['add-new-admin'])){
   $qry = "SELECT * FROM `users` WHERE `userName` LIKE '".$_POST['Username']."'";
    $db = new mysqli('localhost', 'root', '', 'products');
    $rs = $db->query($qry);
    if ($row = $rs->fetch_object()) {
        $_SESSION['this-admin']="exist";
//        echo "here";

    }
    else{
        $qry="INSERT INTO `users` (`userName`, `email`, `password`, `userLevel`) VALUES ('".$_POST['Username']."','".$_POST['email']."','".$_POST['Password']."', '1')";
        $rs = $db->query($qry);
//        echo"hi";

        $_SESSION['this-admin']="n";
        header("location: admin.php");
        exit();
    }
}



if (isset($_POST['barcode'])&& isset($_FILES['product-img'])) try {

     if($_FILES['product-img']['error']){
         echo "Problem";
         switch ($_FILES['product-img']['error']){

             case 1 : echo "File exceeded upload_max_filesize";
                    break;
             case 2 : echo "File exceeded max_file_size";
                        break;
             case 3 : echo "File only partilly uploaded";
                        break;
             case 4 : echo " no file uploaded ";
                        break;
             case 6 : echo "cannot upload file : no temp dircrtory specifed";
                break;
             case 7: echo " Upload failde : Cannot write to disk";
                break;
         }
         exit;
     }




   $db=new mysqli('localhost','root','','products');
    $qry="INSERT INTO `products` (`barcode`, `pName`, `pFor`, `pType`,`pCost`, `pPrice`,`pQuantity`) VALUES ('".$_POST['barcode']."','".$_POST['Product-name']."','".$_POST['Product-for'] ."','".$_POST['Product-type']."','".$_POST['cost']."','".$_POST['price']."','".$_POST['quantity']."')";
    $rs=$db->query($qry);
//    echo $qry;
    $db->commit();
    $barCode="".$_POST['barcode']."";
    if($rs==true) {
        $img_name = $_FILES['product-img']['name'];
        $tmp_name=$_FILES['product-img']['tmp_name'];
        $img_ex=pathinfo($img_name,PATHINFO_EXTENSION);
        $img_ex_lc=strtolower($img_ex);
        $new_img_name=$barCode.'.'.$img_ex_lc;
        $img_upload_path='uploadImg/'.$new_img_name;
        move_uploaded_file($tmp_name,$img_upload_path);

        $qry="UPDATE `products` SET `pImg` = '".$new_img_name."'WHERE `products`.`barcode` = '".$barCode."'";
        mysqli_query($db,$qry);
        $_SESSION['added']="The product with barcode =$barCode added successfully to the database ";
        $db->commit();
        $db->close();
    }
    else {
//        echo "user name is used";
          $_SESSION['barcode-exist']="this Product is already exist ";
    }
}catch (Exception $e){
    echo "not succ";
}
include "adminheader.php";
?>

<?php
    if (isset($_SESSION['added'])){
?>
<div style="position: absolute; top:50px; width: 100%; " class="alert alert-success alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Success!</strong> <?php echo $_SESSION['added']; ?>
</div>
<?php
    unset($_SESSION['added']);
    }?>
<?php
if (isset($_SESSION['barcode-exist'])){
    ?>
    <div style="position: absolute; top:50px; width: 100%; " class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Fail!</strong> <?php echo $_SESSION['barcode-exist']; ?>
    </div>
    <?php
    unset($_SESSION['barcode-exist']);
}?>

<?php
if (isset($_SESSION['this-admin'])){
    if($_SESSION['this-admin']=="exist"){
    ?>
    <div style="position: absolute; top:50px; width: 100%; " class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Failed!</strong> This Username is used by another user  ; ?>
    </div>
    <?php
    }
    if($_SESSION['this-admin']=="n"){
        ?>
        <div style="position: absolute; top:50px; width: 100%; " class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Successes !</strong> The new admin is added successfully  ; ?>
        </div>
    <?php }
    unset($_SESSION['this-admin']);
}?>
<link rel="stylesheet" href="test.css">
<link rel="stylesheet" href="login.css">

<section style="padding-top: 50px; padding-bottom: 100px" class="container-fluid adminMain  ">
<div class="container mt-5  d-flex justify-content-center main-div ">

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
                    <input type="radio" class="form-check-input" id="shoes" name="Product-type" required value="Shoes" >
                    <label class="form-check-label" for="shoes">Shoes</label>
                </div>
                <div class="col">
                    <input type="radio" class="form-check-input" id="shirts" name="Product-type"  value="Shirts" >
                    <label class="form-check-label" for="shirts">Shirts</label>
                </div>
                <div class="col">
                    <input type="radio" class="form-check-input" id="jeans" name="Product-type" value="Jeans" >
                    <label class="form-check-label" for="jeans">Jeans</label>
                </div>
                <div class="col">
                    <input type="radio" class="form-check-input" id="suits" name="Product-type" value="Suits" >
                    <label class="form-check-label" for="suits">Suits</label>
                </div>
            </div>

        </div>
        <div class="mb-3">
            <label for="Product-Cost"><h3>Product Cost:</h3></label>
            <input type="number" class="form-control" id="Product-Cost" placeholder="Enter Product cost" required name="cost">
        </div>
        <div class="mb-3">
            <label for="Product-Price"><h3>Product price:</h3></label>
            <input type="number" class="form-control" id="Product-price" placeholder="Enter Product price" required name="price">
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
