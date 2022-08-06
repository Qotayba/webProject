<?php
if(!isset($_SESSION['user-is-admin'])){
header("location:index.php");
 exit();
}?>
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
    <link rel="stylesheet" href="node_modules/flickity/dist/flickity.min.css">
    <script src="node_modules/flickity/dist/flickity.pkgd.min.js"></script>
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body class="home" onload="setThehegit();" onresize="setThehegit()" style="background: #f5f5f5" >
<script>

</script>
<header>
    <nav class="navbar navbar-expand-sm px-lg-5 navbar-dark bg-dark fixed-top ">
        <div class="container-fluid  ">
            <a class="navbar-brand " href="admin.php">Gallery Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav mx-auto  justify-content-between">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Insert New Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ViewProducts.php">View Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminOrder.php">View Orders</a>
                    </li>

                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php
                        if(isset($_SESSION['login'])){
                            ?>
                            <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary mx-lg-2" data-bs-toggle="modal" data-bs-target="#addAdmin">
                                add admin</button>

                            <form action="index.php" method="post">
                                <button type="submit" name="logout" id="logout" class="btn btn-primary">Log Out</button>
                            </form>
                            </div>
                        <?php }
                    ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


</header>
<div style="display: none">
    <img src="imgs/ad1.jpg">
    <img src="imgs/ad2.jpg">
    <img src="imgs/ad3.jpg">
    <img src="imgs/ad4.jpg">
    <img src="imgs/ad5.jpg">

</div>
<div class="modal  m-lg-5" id="addAdmin">
    <div class="modal-dialog">
        <div style="" class=" loginBox modal-content">
            <div class="text-lg-end" style="display: flex;justify-content: right">
                <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <img class="user" src="imgs/login.png" height="100px" width="100px">

            <h3>add a new admin here</h3>
            <form style="width: 100%" action="admin.php" method="post">
                <div class="inputBox">
                    <input id="email" type="email" name="email" required placeholder="Email">
                    <input id="uname" type="text" name="Username" required placeholder="Username">
                    <input id="pass" type="password" name="Password" required placeholder="Password">
                </div>
                <input type="submit" name="add-new-admin" value="add">
            </form>
        </div>
    </div>
</div>
