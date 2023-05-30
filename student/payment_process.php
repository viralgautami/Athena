<?php
session_start();
include_once("../config.php");
    $amt=0;
    $name=$_POST['name'];
    mysqli_query($conn,"UPDATE student_master set Penalty='0' where S_id='$name'");
?>
