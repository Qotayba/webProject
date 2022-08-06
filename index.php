<?php
$sec=array("Shirts","Jeans","Shoes","Suits");
$grpcell="groupCells";
include "logincheck.php";
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
    ?>


</header>

<div class="modal  m-lg-5" id="myModal1">
    <div class="modal-dialog">
        <div style="" class=" loginBox modal-content">
            <div class="text-lg-end" style="display: flex;justify-content: right">
                <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <img class="user" src="imgs/login.png" height="100px" width="100px">

            <h3>Sign Up here</h3>
            <form style="width: 100%" action="index.php" method="post">
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
<div style="display: none">
    <img src="imgs/col1.jpg">
    <img src="imgs/col2.jpg">
    <img src="imgs/col3.jpg">
    <img src="imgs/col4.jpg">
    <img src="imgs/col5.jpg">
</div>

<section id="sec1" class="container-fluid main">
    <div class="container-fluid">
        <form class= "d-flex  mx-auto" action="search.php" method="post">

            <input style="min-width: 100px" class="form-control "  name="textSearch" type="text" placeholder="Search">
            <button style="min-width: 50px" name="Search-btn" class="btn btn-primary mx-lg-2" type="submit">Search</button>

        </form>
    </div>
</section>
<div class="container" >
    <div class="title" style="margin-top: 25px; font-size: 30px;" >Sections</div>
    <div class="department d-flex flex-row " style="margin-bottom: 25px;background: #f5f5f5">
        <a href="shirts.php"  >
            <img src="imgs/shirts.jpg" alt="">
            <label for="a1"  style="">Shirts</label>
        </a>
        <a href="shoes.php" >
            <img src="imgs/shos1.jpg" alt="">
            <label for="a1" style="">Shoes</label>
        </a>
        <a href="jeans.php" >
            <img src="imgs/jen2.jpg"  alt="">
            <label for="a1" style="">Jeans</label>
        </a>
        <a href="suits.php" >
            <img src="imgs/sut.jpg" alt="">
            <label for="a1" style="">Suits</label>
        </a>
    </div>
<?php
$sec=array("Shirts","Jeans","Shoes","Suits");
    for ($z=0;$z<4;$z++) {  ?>

        <a class='title' href='<?php echo $sec[$z].".php" ?>
'><?php echo $sec[$z]  ?> </a>
        <div class='carousel' data-flickity='{
            "groupCells": true }' style='margin-top: 25px;margin-bottom: 50px'>
            <?php

        $db = new mysqli('localhost', 'root', '', 'products');
        if (!isset($_GET['pTybe'])) {
            $qry = "SELECT * FROM `products` where pType like '".$sec[$z]."'";
            $Rs = $db->query($qry);

            for ($x = 1; $x < 10; $x++) {
                if ($row = $Rs->fetch_object()) {
                    if ($row->pType == "$sec[$z]") {
                        echo '
                        <div class="carousel-cell" >
                            <div class ="card cardd mx-2" style="max-width: 350px;margin-right: 5px">
                                <div class="card__relative">
                                    <div class="justify-content-center">
                                        <img src="uploadImg/' . $row->pImg . '" style="height: 350px;max-width: 350px" id="#imm" class="card-img img-in-card"  alt="...">
                                        <div onload="setThehegit()" class="img__hover">
                                            <div class="title-card">' . $row->pName . '</div>
                                            <p class="card-price"> ' . $row->pPrice . '$</p>
                                            <a class="btn btn-primary" href="productPage.php?barcode='.$row->barcode.','.$row->pType.','.$row->pFor.'">Buy now</a>    
                                        </div>
                
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">' . $row->pName. '<br>' . $row->pFor . '</p>
                                </div>
                            </div>
                        </div> 
                        ';
                    }
                    else{
                        break;
                    }
                }
            }
        }
   echo '</div>';
        }
        ?>
        </div>


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
                                © 2022 Copyright:
                                <a class="text-white" href="index.php"
                                >GalleryStore.com</a
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
    <?php
    if(isset($_SESSION['popup'])) {
        echo '<script type="text/javascript">
			$(document).ready(function(){
				$('.'"'.$_SESSION["popup"].'"'.').modal("show");
			});
		</script>';

        if(isset($_SESSION["msg"])) {
            echo '<div style="position: absolute; z-index: 9999;top:50px; width: 100%; " class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>'.$_SESSION["msg"].'</strong>
                </div>';
        }
        unset($_SESSION['popup']);
        unset($_SESSION['msg']);
    }
    ?>
</body>
</html>