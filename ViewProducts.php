<?php
session_start();
if ( isset($_GET['edit']) ){
//    echo "hi";
    $db=new mysqli('localhost','root','','products');
    $id1=$_GET['edit'];
    $newPrice=$_GET['newP'];
    $newQun=$_GET['newQ'];
    $qry3="UPDATE products SET pPrice=".$newPrice.", pQuantity=".$newQun." WHERE barcode=".$id1;
//    echo $qry3;
    $Rs=$db->query($qry3);
    if($Rs==1){

        $_SESSION['delete']="Product with Bar code=$id1 is updated Successfully";
        $db->close();
         header("location:ViewProducts.php");
         exit();
    }
}

if( isset($_GET['delete']) ){
    $db=new mysqli('localhost','root','','products');
    $id=$_GET['delete'];

    $qry2="DELETE FROM products WHERE barcode=".$id;
    $Rs =$db->query($qry2);
    $imTod=$_GET['img-to-d'];
    if($Rs==1){
        unlink("$imTod");

        $_SESSION['delete']="Product with Bar code=$id is deleted Successfully";

        $db->close();
        header("location:ViewProducts.php");
        exit;
    }


}
include "adminheader.php";
    if (isset($_SESSION['delete'])){
?>
<div style="position: absolute; top:50px; width: 100%; " class="alert alert-success alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Success!</strong> <?php echo $_SESSION['delete']; ?>
</div>
<?php
    unset($_SESSION['delete']);
    }
if (isset($_SESSION['delete'])){
    echo "still set";
}

?>
<section class="container-fluid adminMain">
<div style="margin-top: 80px; border: black solid 2px; " class="container pt-lg-5 main-view-product ">

    <h1 class="text-center">Products</h1>
<div style="z-index:500" class="d-flex container justify-content-between ">
    <h3 class="Text-center">You can Edit or delete products
    </h3>
    <div class="dropdown dropstart">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            filter
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item " href="ViewProducts.php">all</a></li>
            <li><a class="dropdown-item " href="ViewProducts.php?pTybe=Jeans">Jeans</a></li>
            <li><a class="dropdown-item " href="ViewProducts.php?pTybe=Shirts">Shirts</a></li>
            <li><a class="dropdown-item " href="ViewProducts.php?pTybe=Shoes">Shoes</a></li>
            <li><a class="dropdown-item " href="ViewProducts.php?pTybe=Suits">Suits</a></li>
        </ul>
    </div>
</div>
    <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
        <tr class="bg-light w-75">
            <th >Bar code</th>
            <th >Product Name</th>
            <th>Product for </th>
            <th >Product type  </th>
            <th>Cost </th>
            <th >Price </th>
            <th >Quantity</th>
            <th> Profit</th>
            <th>Product Image </th>
            <th> operation </th>

        </tr>
        </thead>
        <tbody>
        <?php

          $db=new mysqli('localhost','root','','products');
            if(  !isset($_GET['pTybe'])) {
                $qry ="SELECT * FROM `products`";
            }
            else{
                $qry="SELECT * FROM `products` WHERE `pType` LIKE '".$_GET['pTybe']."'";

            }
                $Rs =$db->query($qry);
        $totalProfit=0;
        $rowcount=0;
                while ($row =$Rs->fetch_object()){
                    $imgPath="uploadImg/".$row->pImg;
                    $totalProfit=(int)$row->profit+$totalProfit;
                    $rowcount=$rowcount+1;
                    ?>

                    
                    <tr style="height:  250px;background-color: antiquewhite">
                        <form action="ViewProducts.php" method="get">
                        <td class="text-center"><?php echo $row->barcode; ?></td>
                        <td class="text-center"><?php echo $row->pName;?></td>
                        <td class="text-center"><?php echo $row->pFor;?> </td>
                        <td class="text-center"><?php echo $row->pType;?></td>
                        <td class="text-center"><?php echo $row->pCost;?></td>
                        <td class="text-center"><input type="number" name="newP" id="" value="<?php echo $row->pPrice;?>"></td>
                        <td class="text-center"><input type="number" name="newQ" id="" value="<?php echo $row->pQuantity;?>"></td>
                        <td class="text-center"><?php echo $row->profit;?></td>
                        <td class="text-center"><img style="height: 250px; width: 250px" src="<?php echo $imgPath;?>"></td>
                        <td>
                            <div>
                            <a style="width: 100%;" href="ViewProducts.php?delete=<?php echo $row->barcode;?>&&img-to-d=<?php echo $imgPath?>" class="btn btn-danger"><img src="icon/delete.png" width =25px alt="">Delete </a>
                            </div>
                                <div style="width: 100%" class="mt-3">
                                    <button class ="btn btn-primary"  type="submit" value="<?php echo $row->barcode; ?>" name="edit">
                                        <img width="25px" src="icon/edit.png" alt=""> update </button>
                                </div>
                        </td>
                            

                    </tr>
                    </form>

        <?php
            }
            $db->close();
         if ($rowcount>0 ){ ?>
        <tr style="height:  250px;background-color: antiquewhite">
            <td ></td>
            <td ></td>
            <td> </td>
            <td >  </td>
            <td> </td>
            <td > </td>
            <td ></td>
            <td> total <?php echo $totalProfit?> </td>
            <td> </td>
            <td>  </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

    </div>
</section>
</div>
