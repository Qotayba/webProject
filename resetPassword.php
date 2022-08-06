<?php
session_start();
$db = new mysqli('localhost', 'root', '', 'products');
    $qry = "SELECT * FROM `users` WHERE `userName` LIKE '".$_SESSION['currentUser']."'";
    $db = new mysqli('localhost', 'root', '', 'products');
    $rs = $db->query($qry);
    if ($row = $rs->fetch_object()) {
            $qry = "UPDATE `users` SET `password` = '" . $_POST['pass1'] . "'WHERE `users`.`userName` = '" . $_SESSION['currentUser'] . "'";
            mysqli_query($db, $qry);
            header("location:index.php");
    }
?>

