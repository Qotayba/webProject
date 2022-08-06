<?php
$db = new mysqli('localhost', 'root', '', 'products');
if (isset($_POST['SignUp'])) {
//    echo"here";
    $qry = "SELECT * FROM `users` WHERE `userName` LIKE '".$_POST['Username1']."'";
    $db = new mysqli('localhost', 'root', '', 'products');
    $rs = $db->query($qry);
    if ($row = $rs->fetch_object()) {
        $_SESSION['this-user']="exist";
        header("location:index.php");
//        echo "here";

    }
    else{
        $qry="INSERT INTO `users` (`userName`, `email`, `password`, `userLevel`) VALUES ('".$_POST['Username1']."','".$_POST['email1']."','".$_POST['Password1']."', '0')";
        $rs = $db->query($qry);
//        echo"hi";
        $_SESSION['currentUser']=$_POST['Username1'];
        header("location: index.php");
        exit();
    }
}
?>