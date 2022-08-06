<?php
include "logincheck.php";

if(isset( $_POST['add-to-cart-sub'] )){

    if(isset($_SESSION['currentUser'])){
        $qry="SELECT * FROM `order` WHERE  userName like '".$_SESSION['currentUser']."' AND aFromUser like '0'";
        $db = new mysqli('localhost', 'root', '', 'products');
        $rs = $db->query($qry);
        if ($rs) {
            if (!$row = $rs->fetch_object()) {
                $qry = "INSERT INTO `order` (`orderId`, `userName`, `mobNum`, `location`, `aFromUser`, `aFromAdmin`) VALUES (NULL, '" . $_SESSION['currentUser'] . "', '0', '0', '0', '0')";
                $rs = $db->query($qry);
            }
            $qry = "SELECT * FROM `order` WHERE  userName like '" . $_SESSION['currentUser'] . "' AND aFromUser like '0'";
            $rs = $db->query($qry);
            $row = $rs->fetch_object();
            $orId = $row->orderId;

            $qry = "SELECT * FROM `cart` WHERE  	orderId  like '" . $orId . "' AND barcode like '" . $_POST['add-to-cart-sub'] . "'";
            $cheakRs = $db->query($qry);
            if (!$cheakRow = $cheakRs->fetch_object()) {
                $qry = "INSERT INTO `cart` values ('" . $row->orderId . "','" . $_POST['add-to-cart-sub'] . "','" . $_POST['quantity'] . "')";
                $rs = $db->query($qry);
                $_SESSION['alert-msg']="s";
            }
            else {
                $_SESSION['alert-msg']="f";

            }
        }
    }
    else{

        $_SESSION['userNotLogin']="you need to log in first ";
    }


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
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"> </script>
    <script srr="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <!--    link my styles-->
    <link rel="stylesheet" href="animationCover.css">
    <link rel="stylesheet" href="forcards.css">
    <link rel="stylesheet" href="wrapp.css">
    <link rel="stylesheet" href="myStyle.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="node_modules/flickity/dist/flickity.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <script src="node_modules/flickity/dist/flickity.pkgd.min.js"></script>
    <title>Document</title>
</head>
<body class="home" style="background: #f5f5f5" >
<script>

</script>
<header>
    <?php
    include "navbar.php";
    ?>


</header>
<?php
if (isset($_SESSION['alert-msg'])){

    if($_SESSION['alert-msg']=="s"){
                        ?>
            <div style="position: absolute; top:50px; width: 100%; " class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Success!</strong> This product added successfully;
            </div>
    <?php

} else{?>
        <div style="position: absolute; top:50px; width: 100%; " class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>failed!</strong>  this product already exist
        </div>
<?php
}
    unset($_SESSION['alert-msg']);
}  ?>
<?php
if(isset($_SESSION['userNotLogin'])){?>
    <div style="position: absolute; top:50px; width: 100%; " class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>failed!</strong> <?php echo $_SESSION['userNotLogin'] ?>
    </div>
<?php
unset($_SESSION['userNotLogin']);
}

?>
<div class="modal  m-lg-5" id="myModal">
    <div class="modal-dialog">
        <div style="" class=" loginBox modal-content">
            <div class="text-lg-end" style="display: flex;justify-content: right">
                <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <img class="user" src="imgs/login.png" height="100px" width="100px">

            <h3>Sign in here</h3>
            <form style="width: 100%" action="productPage.php" method="post">
                <div class="inputBox"> <input id="uname" type="text" name="Username" placeholder="Username">
                    <input id="pass" type="password" name="Password" placeholder="Password">
                </div>
                <input type="submit" name="Signin" id="Signin" value="Login">
            </form> <a style="margin-bottom: 5px" id="lgn" href="#">Forget Password<br> </a>
            <div class="text-center">
                <p style="color: #dc3545;">Don't have account ?  <a id="lgn1" data-bs-toggle="modal" data-bs-target="#myModal1">Sign Up</a></p>

            </div>
        </div>
    </div>
</div>
<div class="modal  m-lg-5" id="myModal1">
    <div class="modal-dialog">
        <div style="" class=" loginBox modal-content">
            <div class="text-lg-end" style="display: flex;justify-content: right">
                <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <img class="user" src="imgs/login.png" height="100px" width="100px">

            <h3>Sign Up here</h3>
            <form style="width: 100%" action="productPage.php" method="post">
                <div class="inputBox">
                    <input id="email" type="email" name="email" required placeholder="Email">
                    <input id="uname" type="text" name="Username" required placeholder="Username">
                    <input id="pass" type="password" name="Password" required placeholder="Password">
                </div>
                <input type="submit" name="SignUp" value="SignUp">
            </form>
        </div>
    </div>
</div>
<?php
$got=$_GET['barcode'];
$barc=explode(",",$got)[0];
$sec=explode(",",$got)[1];
$for=explode(",",$got)[2];

 $db=new mysqli('localhost','root','','products');
                $qry ="SELECT * FROM `products` WHERE `products`.`barcode`=".$barc;
                $Rs =$db->query($qry);
                $row = $Rs->fetch_object();
                    echo '
                    <div class="container fordiv" >
                        <img src="uploadImg/'.$row->pImg.'" class="product_img" alt="">
                        <div class="vl"></div>
                        <div class="title1 col-flex" style="width: 30%;">
                            <h1 style="margin-bottom: 5px">'.$row->pName.'</h1> 
                            Barcode: '.$row->barcode.' <br>
                            <h4 style="margin-bottom: 5px;margin-top: 5px">Price: '.$row->pPrice.'$</h4>
                            <form action="productPage.php?barcode='.$got.'" method="post" class="col-flex"> ';
                            if($sec=="Suits" or $sec=="Shirts" or $sec=="Jeans"){
                                echo '<label for="dvlbl">Size:</label>
                                     
                                    <div id="dvlbl" style="margin-top: 5px;margin-bottom: 5px">
                                        <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
                                        <label class="btn btn-outline-danger" for="danger-outlined">S</label>
                                        <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined1" autocomplete="off">
                                        <label class="btn btn-outline-danger   " for="danger-outlined1">M</label>
                                        <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined2" autocomplete="off">
                                        <label class="btn btn-outline-danger" for="danger-outlined2">L</label>
                                        <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined3" autocomplete="off">
                                        <label class="btn btn-outline-danger   " for="danger-outlined3">XL</label>
                                        <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined4" autocomplete="off">
                                        <label class="btn btn-outline-danger   " for="danger-outlined4">XXL</label>
                                    </div>
                                ';
                            }
                            elseif($sec="shoes" and $for=="men") {
                                echo '
                                    <div id="divsize">
                                    <label for="fivsize">Size:</label><br>
                                ';
                                for($x=36;$x<47;$x++){
                                    echo '
                                         <input required type="radio"  class="btn-check" name="options-outlined" id="danger-outlined'.$x.'" autocomplete="off">
                                        <label class="btn btn-outline-danger   " for="danger-outlined'.$x.'">'.$x.'</label>
                                    ';
                                }
                                echo '</div>';
                            }
                            elseif($sec="shoes" and $for=="women"){
                                echo '
                                    <div id="divsize1">
                                    <label for="fivsize1">Size:</label><br>
                                ';
                                for($x=30;$x<42;$x++){
                                    echo '
                                         <input required type="radio" class="btn-check" name="options-outlined" id="danger-outlined'.$x.'" autocomplete="off">
                                        <label class="btn btn-outline-danger" for="danger-outlined'.$x.'">'.$x.'</label>
                                    ';
                                }
                                echo '</div>';
                            }
                            elseif($sec="shoes" and $for=="children"){
                                echo '
                                    <div id="divsize2">
                                    <label for="fivsize2">Size:</label><br>
                                ';
                                for($x=14;$x<28;$x++){
                                    echo '
                                         <input required type="radio" class="btn-check" name="options-outlined" id="danger-outlined'.$x.'" autocomplete="off">
                                        <label class="btn btn-outline-danger" for="danger-outlined'.$x.'">'.$x.'</label>
                                    ';
                                }
                                echo '</div>';
                            }

                            echo '
                                <label for="nmbr"><h4>Quantity:</h4></label>
                                <input type="number" id="nmbr" min="1" max="'.$row->pQuantity.'" name="quantity" step="1" value="1" style="width: 15vw; border-width:1px; border-radius: 20px; border-color: #dc3545 ; color:#dc3545; font-size: 20px ; text-align: center "> 
                                <hr>
                               
                                <button name="add-to-cart-sub" type="submit" value="'.$row->barcode.'" class="btn btn-outline-danger" style="width: 15vw; border-radius: 20px;margin-top: 5px">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    ';
?>

<div style="all:unset;" class="container my-5 " >
    <!-- Footer -->
    <footer
            class="text-center text-lg-start text-white bg-dark "
            style=" margin-top: 75px"
    >
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Links -->
            <section class="">
                <!--Grid row-->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            Company name
                        </h6>
                        <p style="color: #0000ff;">
                            Gallery Store
                        </p>
                    </div>
                    <!-- Grid column -->

                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>
                        <p>
                            <a class="text-white">Shirts</a>
                        </p>
                        <p>
                            <a class="text-white">Shoes</a>
                        </p>
                        <p>
                            <a class="text-white">Jeans</a>
                        </p>
                        <p>
                            <a class="text-white">Suits</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            Creat By
                        </h6>
                        <p>
                            <a class="text-white">Haitham Hinnawi</a>
                        </p>
                        <p>
                            <a class="text-white">Qotayba Darawsheh</a>
                        </p>
                    </div>

                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                        <p style="color: #0000ff;"><i class="fas fa-envelope mr-3"></i> haithamhinnawi9@gmail.com</p>
                        <p style="color: #0000ff;"><i class="fas fa-envelope mr-3"></i> qotayba.darawshi@gmail.com</p>
                        <p style="color: #0000ff;"><i class="fas fa-phone mr-3"></i> +970 597 505 661</p>
                        <p style="color: #0000ff;"><i class="fas fa-phone mr-3"></i> +970 598 520 816</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!--Grid row-->
            </section>
            <!-- Section: Links -->

            <hr class="my-3">

            <!-- Section: Copyright -->
            <section class="p-3 pt-0">
                <div class="row d-flex align-items-center">
                    <!-- Grid column -->
                    <div class="col-md-7 col-lg-8 text-center text-md-start">
                        <!-- Copyright -->
                        <div class="p-3">
                            © 2020 Copyright:
                            <a class="text-white" href="https://mdbootstrap.com/"
                            >MDBootstrap.com</a
                            >
                        </div>
                        <!-- Copyright -->
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                        <!-- Facebook -->
                        <a
                                class="btn btn-outline-light btn-floating m-1"
                                class="text-white"
                                href="https://www.facebook.com/haitham.hinnawi.3"
                                target="_blank"
                                role="button"
                        ><i class="fab fa-facebook-f"></i
                            ></a>

                        <!-- Twitter -->
                        <a
                                class="btn btn-outline-light btn-floating m-1"
                                class="text-white"
                                href="https://twitter.com/Qotayba4"
                                target="_blank"
                                role="button"
                        ><i class="fab fa-twitter"></i
                            ></a>

                        <!-- Instagram -->
                        <a
                                class="btn btn-outline-light btn-floating m-1"
                                class="text-white"
                                href="https://www.instagram.com/haitham.hinnawi/"
                                target="_blank"
                                role="button"
                        ><i class="fab fa-instagram"></i
                            ></a>
                    </div>
                    <!-- Grid column -->
                </div>
            </section>
            <!-- Section: Copyright -->
        </div>
        <!-- Grid container -->
    </footer>
    <!-- Footer -->
</div>
