<?php
session_start();
if (!isset($_SESSION['currentUser'])){
    header("location: index.php");
    exit();
}
if(isset($_POST['delete-order'])){

    $db=new mysqli('localhost','root','','products');
    $qry="DELETE FROM `order` WHERE `order`.`orderId` =".$_POST['delete-order'];
    $rs=$db->query($qry);
    $_SESSION['delete-order']="This order Deleted successfully";
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


<header>

    <?php
    include "navbar.php";
    if (!isset($_SESSION['currentUser'])){
        header("location:index.php");
        exit();
    }?>

</header>
<?php if (isset( $_SESSION['delete-order'])){?>

    <div style="position: absolute; top:50px; width: 100%; " class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> <?php echo $_SESSION['delete-order']; ?>
    </div>
    <?php
    unset($_SESSION['delete-order']);
}
?>
<link rel="stylesheet" href="login.css">
<section class="container-fluid main">
    <div style="margin-top: 80px; border: black solid 2px; " class="container pt-lg-5 main-view-product">

        <h1 class="text-center">My order that not submitted from admin yet </h1>
        <div style="z-index:500" class=" container">
            <h3 style="    color: white; font-family: 'Pacifico', cursive;" class="Text-center">You can delete your order
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                <tr class="bg-light w-75">
                    <th class="text-center">count</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">Mobile number </th>
                    <th class="text-center" >Price of this order  </th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $orderId=0;
                $allTotal=0;
                $rowCount=0;
                $db=new mysqli('localhost','root','','products');
                $qry="SELECT * FROM `order` WHERE  userName like '".$_SESSION['currentUser']."' AND aFromUser like '1' and aFromAdmin ='0'";
                $Rs =$db->query($qry);
                while ( $rowOrder=$Rs->fetch_object()){
                    $rowCount=$rowCount+1
                        ?>


                        <tr style="height:  150px;background-color: antiquewhite">
                            <form action="myOrder.php" method="post">
                                <td class="text-center"><?php   echo $rowCount; ?></td>
                                <td class="text-center"><?php echo $rowOrder->	location; ?></td>
                                <td class="text-center"><?php echo $rowOrder->mobNum;?></td>
                                <td class="text-center"><?php echo $rowOrder->tPrice;?> </td>
                                <td>
                                    <div style="width: 100%" class="mt-3 d-flex flex-column">

                                        <button  class ="btn btn-danger w-100 mt-5"  type="submit" value="<?php echo $rowOrder->orderId ; ?>" name="delete-order">
                                            <img src="icon/delete.png" height="25px" width =25px alt="">Delete
                                        </button>
                                    </div>
                                </td>

                            </form>
                        </tr>




                        <?php
                    }
                 ?>

        <?php
         $db->close();




        ?>


        </tbody>
        </table>
<!--                                                                                                                                    -->
<!--             ----------------------------new table-------------------------------------                                            -->
<!--                                                                                                                                    -->
            <h1 class="text-center">My order that submitted from admin  </h1>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                    <tr class="bg-light w-75">
                        <th class="text-center">count</th>
                        <th class="text-center" >Location</th>
                        <th class="text-center">Mobile number </th>
                        <th class="text-center" >Price of this order  </th>
<!--                        <th></th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $orderId=0;
                    $allTotal=0;
                    $rowCount=0;
                    $db=new mysqli('localhost','root','','products');
                    $qry="SELECT * FROM `order` WHERE  userName like '".$_SESSION['currentUser']."' AND aFromUser like '1' and aFromAdmin ='1'";
                    $Rs =$db->query($qry);
                    while ( $rowOrder=$Rs->fetch_object()){
                        $rowCount=$rowCount+1
                        ?>


                        <tr style=" opacity: 5 height:  150px;background-color: antiquewhite">
                            <form action="myOrder.php" method="post">
                                <td class="text-center"><?php   echo $rowCount; ?></td>
                                <td class="text-center"><?php echo $rowOrder->	location; ?></td>
                                <td class="text-center"><?php echo $rowOrder->mobNum;?></td>
                                <td class="text-center"><?php echo $rowOrder->tPrice;?> </td>
<!--                                <td>  <div style="width: 100%"></div>-->

                                </td>

                            </form>
                        </tr>




                        <?php
                    }
                    ?>

                    <?php
                    $db->close();




                    ?>


                    </tbody>
                </table>

    </div>
</section>
</div>

</div>
</body>




