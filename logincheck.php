<?php
session_start();
$db = new mysqli('localhost', 'root', '', 'products');
if (isset($_POST['logout'])){
    echo "<br><br><br><br>here";
    unset($_SESSION['currentUser']);
    unset($_SESSION['login']);
    unset($_SESSION['user-is-admin']);
    header("location:index.php");
    exit();
}
elseif (isset($_POST['Signin'])) {
//    echo"here";
    $qry = "SELECT * FROM `users` WHERE `userName` LIKE '".$_POST['Username']."'";
    $db = new mysqli('localhost', 'root', '', 'products');
    $rs = $db->query($qry);
    if ($row = $rs->fetch_object()) {
        if($row->password==$_POST['Password']) {
            $_SESSION['this-user'] = "exist";
            $_SESSION['currentUser'] = $_POST['Username'];
            $_SESSION['login']="true";
            if ($row->userLevel == '1') {
                $_SESSION['user-is-admin']="t";
                header("location:admin.php");
                exit();
            } else {
                $department = "index.php";

            }
        }
        else{
            $_SESSION['popup']="#myModal";
            $_SESSION['msg']="Incorrect Password!";
        }

    }
    else{
        $_SESSION['popup']="#myModal";
        $_SESSION['msg']="Incorrect Username!";
    }
}
