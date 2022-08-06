<?php
session_start();
    if($_SESSION['vcode']==$_POST['code']) {
        $_SESSION['popup']="#myModal4";
        header("location:index.php");
    }
    else{

        $_SESSION['popup']="#myModal3";
        $_SESSION['msg']="Incorrect Verification code!";
        header("location:index.php");
    }
?>

