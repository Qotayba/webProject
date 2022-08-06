
<?php
session_start();
if (isset($_POST['delete-order-admin-oID'] )){
    $db = new mysqli('localhost', 'root', '', 'products');
    $qry="DELETE FROM `order` WHERE `order`.`orderId` =".$_POST['delete-order-admin-oID'];
    $rs = $db->query($qry);

}
if (isset($_POST['abrove-admin-oID'])) {
    $db = new mysqli('localhost', 'root', '', 'products');
    $qry = "SELECT * FROM `order` WHERE `orderId` =" . $_POST['abrove-admin-oID'] . " AND  `aFromUser`  LIKE  '1'  AND `aFromAdmin` LIKE  '0' ";
    $rs = $db->query($qry);
//    echo "<br><br><br> $qry ";
    if ($rs) {
        $rowO = $rs->fetch_object();
        $qry2 = "SELECT * FROM `cart` WHERE `orderId` = " . $_POST['abrove-admin-oID'];
//        echo "<br><br><br> $qry2 ";
        $cRs = $db->query($qry2);
        if ($cRs) {

            while ($rowC = $cRs->fetch_object()) {
                $qry3 = "SELECT * FROM `products` WHERE `barcode` LIKE  '" . $rowC->barcode . "'";
//                echo "qry3 = ".$qry3;
                $userQ = $rowC->quantity;
                $pRs = $db->query($qry3);
                $rowP = $pRs->fetch_object();
                $newPQ = $rowP->pQuantity - $userQ;
                $newQS = $rowP->QunSold + $userQ;
                $newProfit = (int)$rowP->profit + ((int)$userQ * ((int)$rowP->pPrice - (int)$rowP->pCost));
                $qry4 = "UPDATE `products` SET `pQuantity` =" . $newPQ . " , QunSold=" . $newQS . ",profit=" . $newProfit . " WHERE  barcode like '" . $rowC->barcode . "'";
                $rs5 = $db->query($qry4);

            }
            $qry5 = "UPDATE `order` SET `aFromAdmin` = '1' WHERE `order`.`orderId` = ".$_POST['abrove-admin-oID'];
            $rs6 = $db->query($qry5);
        }
    }
}

?>



<?php
include "adminheader.php";
?>
<link rel="stylesheet" href="login.css">
<section class="container-fluid adminMain p-lg-5">
    <div style="margin-top: 80px; border: black solid 2px; " class="container pt-lg-5 main-view-product">

        <h1 class="text-center">Orders  </h1>
        <div style="z-index:500" class=" container">
            <h3 style="    color: white; font-family: 'Pacifico', cursive;" class="Text-center">
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
                    <th class="text-center"> operation </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $orderId=0;
                $allTotal=0;
                $rowCount=0;
                $db=new mysqli('localhost','root','','products');
                $qry="SELECT * FROM `order` WHERE  aFromUser like '1' and aFromAdmin ='0'";
                $Rs =$db->query($qry);
                while ( $rowOrder=$Rs->fetch_object()){
                    $rowCount=$rowCount+1

                    ?>


                    <tr style="height:  150px;background-color: antiquewhite">
                        <form action="adminOrder.php" method="post">
                            <td class="text-center"><?php   echo $rowCount; ?></td>
                            <td class="text-center"><?php echo $rowOrder->	location; ?></td>
                            <td class="text-center"><?php echo $rowOrder->mobNum;?></td>
                            <td class="text-center"><?php echo $rowOrder->tPrice;?> </td>
                            <td>
                                <div style="width: 100%" class="mt-3 d-flex flex-column">
                                    <button style="width: 100%;" href="cart.php" value="<?php echo $rowOrder->orderId ;?>" name="abrove-admin-oID" class="btn btn-primary "><img src="icon/edit.png" height="25px" width =25px alt="">Accept order </button>
                                    <button  class ="btn btn-danger w-100 mt-5"  type="submit" value="<?php echo $rowOrder->orderId ; ?>" name="delete-order-admin-oID">
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


            </div>
</section>
</div>

</div>
</body>

