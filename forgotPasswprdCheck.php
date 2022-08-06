<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
session_start();
$flag=0;
$db = new mysqli('localhost', 'root', '', 'products');
if (isset($_POST['Username2'])) {
    $qry = "SELECT * FROM `users` WHERE `userName` LIKE '".$_POST['Username2']."'";
    $db = new mysqli('localhost', 'root', '', 'products');
    $rs = $db->query($qry);
    if ($row = $rs->fetch_object()) {
        $_SESSION['this-user']="exist";
        $_SESSION['currentUser']=$_POST['Username2'];
        if($row->email==$_POST['email2']){
            try{
                require_once 'email.php';

                $mail->setFrom('gallery.store.2022@gmail.com', 'Haitham');
                $mail->addAddress($_POST['email2']);
                $mail->Subject = 'Reset Password';
                $random=rand(10000,99999);
                $_SESSION['vcode']=$random;
                $mail->Body    = "<h1>The Verification code is:</h1>
                                <h1> $random</h1>";
                $mail->send();
            }catch (Exception $e) {
                echo "jbjb";
            }
            $_SESSION['popup']="#myModal3";
            header("location:index.php");
            $flag=1;
        }


    }
   if($flag==0){
       $_SESSION['popup']="#myModal2";
       $_SESSION['msg']="Incorrect Email or Username!";
       header("location:index.php");
   }
}
?>

