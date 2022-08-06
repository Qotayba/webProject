<?php
session_start();
if (!isset($_SESSION['currentUser'])){
    header("location: index.php");
    exit();
}
if ( isset( $_POST['submit-order'])){

    $db=new mysqli('localhost','root','','products');
    $qry="UPDATE `order` SET `location` ='".$_POST['Location']."' , mobNum='".$_POST['phone-num']."',aFromUser='1' , tPrice=".$_POST['order-price']." WHERE  `order`.`orderId` =".$_POST['orderId-from-submit'];
//    echo "<br><br><br><br><br><br><br>".$qry." <br>".$_POST['orderId-from-submit'];
    $Rs =$db->query($qry);

}
if (isset( $_GET['deleteFromCart'] )){
    $db=new mysqli('localhost','root','','products');
    $qry=" DELETE FROM `cart` WHERE `cart`.`orderId` =".$_GET['orderId']."  AND `cart`.`barcode` = '".$_GET['deleteFromCart']."'";

    $Rs =$db->query($qry);
    $_SESSION['deleted-from-cart']="the product with bar code =".$_GET['deleteFromCart']."deleted successfully from cart";
    header("location: cart.php");
    exit();

}
if(isset( $_POST['edit-cart'])){
    echo "<br><br><br><br><br><br><br><br> hello";
    $db=new mysqli('localhost','root','','products');
    $qry=" UPDATE `cart` SET `quantity` = '".$_POST['newQ']."' WHERE `cart`.`orderId` =".$_POST['order-id-from-hidden-input']." AND `cart`.`barcode` = '".$_POST['edit-cart']."'";
    $Rs =$db->query($qry);
    $_SESSION['update-cart']="the quantity of the product with barcode =".$_POST['edit-cart']. "is updated sucssfully to ".$_POST['newQ'];
    header("location: cart.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--    link bootstrap-->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"> </script>
    <!--    link my styles-->
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="animationCover.css">
    <link rel="stylesheet" href="forcards.css">
    <link rel="stylesheet" href="wrapp.css">
    <link rel="stylesheet" href="myStyle.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="node_modules/flickity/dist/flickity.min.css">
    <script src="node_modules/flickity/dist/flickity.pkgd.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">

    <title>Document</title>
</head>
<body class="home" onload="setThehegit();" onresize="setThehegit()" style="background: #f5f5f5" >
<script>

</script>

<header>

    <?php
    include "navbar.php";
    if (!isset($_SESSION['currentUser'])){
        header("location:index.php");
        exit();
    }
    ?>
    </header>
<?php
if (isset($_SESSION['deleted-from-cart'])){
    ?>
    <div style="position: absolute; top:50px; width: 100%; " class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> <?php echo $_SESSION['deleted-from-cart']; ?>
    </div>
    <?php
    unset($_SESSION['deleted-from-cart']);
}
if (isset($_SESSION['deleted-from-cart'])){
    echo "still set";
}
?>
<?php
if (isset($_SESSION['update-cart'])){
    ?>
    <div style="position: absolute; top:50px; width: 100%; " class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> <?php echo $_SESSION['update-cart']; ?>
    </div>
    <?php
    unset($_SESSION['update-cart']);
}
if (isset($_SESSION['update-cart'])){
    echo "still set";
}
?>
    <section class="container-fluid main">
        <div style="margin-top: 80px; border: black solid 2px; " class="container pt-lg-5 main-view-product">

            <h1 class="text-center">My cart </h1>
            <div style="z-index:500" class=" container">
                <h3 style="    color: white; font-family: 'Pacifico', cursive;" class="Text-center">You can Edit or delete products
                </h3>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                    <tr class="bg-light w-75">
                        <th >Bar code</th>
                        <th >Product Name</th>
                        <th>Product for </th>
                        <th >Product type  </th>
                        <th >Price </th>
                        <th >Quantity</th>
                        <th > Total price</th>
                        <th>Product Image </th>
                        <th> operation </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $orderId=0;
                    $allTotal=0;
                    $rowCount=0;
                    $db=new mysqli('localhost','root','','products');
                    $qry="SELECT * FROM `order` WHERE  userName like '".$_SESSION['currentUser']."' AND aFromUser like '0'";
                    $Rs =$db->query($qry);
                    if ( $rowOrder=$Rs->fetch_object()){
//                        $rowOrder=$Rs->fetch_object();
                        $orderId=$rowOrder->orderId;
                        $qry="SELECT * FROM `cart` WHERE `orderId` =".$orderId;
                        $Rs =$db->query($qry);
                    while ($row =$Rs->fetch_object()){
                        $rowCount=$rowCount+1;
                        $qry55="SELECT * FROM `products` WHERE `barcode` like ".$row->barcode."";
                        $productRs =$db->query($qry55);
                       if ($productRow=$productRs->fetch_object()) {
                           $imgPath = "uploadImg/" . $productRow->pImg;
                           $prPrice=(int)$productRow->pPrice;
                           $userQun=(int)$row->quantity;//quntity entered by user
                           $total=$prPrice * $userQun;
                           $allTotal=$allTotal+$total;
//                           echo "<br> <br>";
//                           echo " price :". $prPrice;
//                           echo "qun"; $userQun;
//                           echo "total ".$total;



                        ?>


                        <tr style="height:  150px;background-color: antiquewhite">
                            <form action="cart.php" method="post">
                                <input type="text" value="<?php echo $orderId ?> " hidden name="order-id-from-hidden-input">
                                <td class="text-center"><?php echo $productRow->barcode; ?></td>
                                <td class="text-center"><?php echo $productRow->pName;?></td>
                                <td class="text-center"><?php echo $productRow->pFor;?> </td>
                                <td class="text-center"><?php echo $productRow->pType;?></td>
                                <td class="text-center"><?php echo $productRow->pPrice;?></td>
                                <td class="text-center"><input type="number" name="newQ" id="" max="<?php echo "$productRow->pQuantity"?>" value="<?php echo $row->quantity;?>"></td>
                                <td class="text-center"><?php echo $total ;?></td>
                                <td class="text-center"><img style="height: 250px; width: 250px" src="<?php echo $imgPath;?>"></td>
                                <td>
<!--                                    <div>-->
<!--                                        <a style="width: 100%;" href="ViewProducts.php?delete=--><?php //echo $row->barcode; ?><!--&&img-to-d=--><?php //echo $imgPath ?><!--" class="btn btn-danger"><img src="icon/delete.png" width =25px alt="">Delete </a>-->
<!--                                    </div>-->
                                    <div style="width: 100%" class="mt-3 d-flex flex-column">
                                        <a style="width: 100%;" href="cart.php?deleteFromCart=<?php echo $row->barcode;?>&&orderId=<?php echo $orderId ?>" class="btn btn-danger"><img src="icon/delete.png" height="25px" width =25px alt="">Delete </a>
                                        <button  class ="btn btn-primary w-100 mt-5"  type="submit" value="<?php echo $row->barcode; ?>" name="edit-cart">
                                            <img width="25px" height="25px" src="icon/edit.png" alt=""> Update
                                        </button>
                                    </div>
                                </td>

                            </form>
                        </tr>




                        <?php
                    }
                    }
                    if ($rowCount>0){
                    ?>

                    <tr class ="bg-light w-75">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>total <?php echo $allTotal; ?></td>
                        <td></td>
                        <td>
                            <button style="width: 100%" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#submitModal">
                                Submit order</button></td>
                    </tr>
                        <div class="modal  m-lg-5" id="submitModal">
                            <div class="modal-dialog">
                                <div style="" class=" loginBox modal-content">
                                    <div class="text-lg-end" style="display: flex;justify-content: right">
                                        <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

<!--                                    <img class="user" src="imgs/login.png" height="100px" width="100px">-->

<!--                                    <h3>Sign in here</h3>-->
                                    <form style="width: 100%" action="cart.php" method="post">
                                        <div class="inputBox">
                                            <input type="text" value="<?php echo $allTotal?>" hidden name="order-price"  >
                                            <input type="text" value="<?php echo $orderId?>" hidden name="orderId-from-submit"  >
                                            <input id="phone-num" type="text" name="phone-num" placeholder="Phone number">
                                            <input id="pass" type="text" name="Location" placeholder="location">
                                        </div>
                                        <input type="submit" name="submit-order" id="" value="Submit Order">
                                    </form>


                                    </div>
                                </div>
                            </div>
                        </div>
<?php }
                    } $db->close();


                    ?>


                    </tbody>
                </table>

            </div>
    </section>
</div>

</div>
</body>