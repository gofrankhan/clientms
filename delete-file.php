<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
    header('location:logout.php');
  } else{
    $invid=$_GET['invoiceid'];
    $filename=$_GET['filename'];
    echo $filename;
    $filename = str_replace("xxx", " 20", $filename);
    $filename = str_replace("%", " ", $filename);
    echo $filename;
    chmod("./uploads/".$invid."/".$filename, 0777); 
    unlink("./uploads/".$invid."/".$filename);
    echo "./uploads/".$invid."/".$filename;
    header('location:view-invoice.php?invoiceid='.$invid);
}
?>