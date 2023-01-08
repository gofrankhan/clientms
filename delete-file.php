<?php
ob_start();
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
    header('location:logout.php');
  } else{
    $id=$_GET['id'];
    $ret = 'select * from tbl_files where id=:id';
		$query1 = $dbh -> prepare($ret);
		$query1->bindParam(':id',$id,PDO::PARAM_STR);
		$query1->execute();
		$results=$query1->fetchAll(PDO::FETCH_OBJ);
    foreach($results as $row){
      $invid = $row->invid;
      $filename = $row->file_name;
    }
		
    chmod("./uploads/".$invid."/".$filename, 0777); 
    unlink("./uploads/".$invid."/".$filename);
    echo "./uploads/".$invid."/".$filename;
    $delQ = 'DELETE FROM tbl_files WHERE id=:id';
    $query1 = $dbh -> prepare($delQ);
		$query1->bindParam(':id',$id,PDO::PARAM_STR);
		$query1->execute();
    header('location:view-invoice.php?invoiceid='.$invid);
}
?>