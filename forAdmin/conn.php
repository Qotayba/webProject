<?php
$db=new mysqli('localhost','root','','database');
if ($db->connect_errno){
    echo "connect faild to the data base";
}
