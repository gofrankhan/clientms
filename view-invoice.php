<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
  } else{
  	?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Client Management Sysytem || View File </title>
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!-- Graph CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- jQuery -->
	<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
	<!-- lined-icons -->
	<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
	<!-- /js -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<!-- //js-->
</head> 
<body>
	<div class="page-container">
		<!--/content-inner-->
		<div class="left-content">
			<div class="inner-content">
				<!-- header-starts -->
				<?php include_once('includes/header.php');?>
				<!-- //header-ends -->
				<!--outter-wp-->
				<div class="outter-wp">
					<!--sub-heard-part-->
					<div class="sub-heard-part">
						<ol class="breadcrumb m-b-0">
							<li><a href="dashboard.php">Home</a></li>
							<li class="active">View File</li>
						</ol>
					</div>
					<!--//sub-heard-part-->
		<div class="graph-visual tables-main" id="exampl">
						
					
						<h3 class="inner-tittle two">File Details </h3>
<?php
$invid=intval($_GET['invoiceid']);
$currdir = getcwd();
if (!file_exists($currdir."/uploads/".$invid)) {
	chmod($currdir, 0777);
	if (!@mkdir("./uploads/".$invid, 0777, true)) {
		$error = error_get_last();
		echo $error['message'];
	}
}
$sql="select distinct tblclient.FirstName,tblclient.LastName,tblclient.CompanyName,tblclient.Mobilephnumber,tblclient.TaxID,tblclient.AccountID,tblinvoice.BillingId,tblinvoice.PostingDate from  tblclient   
	join tblinvoice on tblclient.ID=tblinvoice.Userid  where tblinvoice.BillingId=:invid";
$query = $dbh -> prepare($sql);
$query->bindParam(':invid',$invid,PDO::PARAM_STR);
$query->execute();

$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
						<div class="graph">
							<div class="tables">
								<h4>Files #<?php echo $invid;?></h4>
													<table class="table table-bordered" width="80%" border="1"> 
<tr>
<th colspan="8">Client Details</th>	
</tr>
							 <tr> 
								<th>Contact Name</th> 
								<td><?php  echo htmlentities($row->FirstName);?> <?php  echo htmlentities($row->LastName);?></td>
								<th>Comapny Name</th> 
								<td><?php  echo htmlentities($row->CompanyName);?></td> 
							</tr>
							<tr> 
								<th>TAX ID</th> 
								<td><?php echo htmlentities($row->TaxID);?></td> 
								<th>Account ID</th> 
								<td colspan="6"><?php echo  htmlentities($row->AccountID);?></td> 
							</tr> 
							<tr>
								<th>Contact no.</th> 
								<td><?php  echo htmlentities($row->Mobilephnumber);?></td>
								<th>File Created</th> 
								<td colspan="6"><?php echo  htmlentities($row->PostingDate);?></td>
							</tr> 
<?php $cnt=$cnt+1;}} ?>
</table>
<table class="table table-bordered" width="100%" border="1"> 
<tr>
<th colspan="3">Services Details</th>	
</tr>
<tr>
<th>#</th>	
<th>Service</th>
<th>Cost</th>
</tr>

<?php
$ret="select tblservices.ServiceName,tblservices.ServicePrice  
	from  tblinvoice 
	join tblservices on tblservices.ID=tblinvoice.ServiceId 
	where tblinvoice.BillingId=:invid";
$query1 = $dbh -> prepare($ret);
$query1->bindParam(':invid',$invid,PDO::PARAM_STR);
$query1->execute();

$results=$query1->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query1->rowCount() > 0)
{
foreach($results as $row1)
{               ?>

<tr>
<th><?php echo $cnt;?></th>
<td><?php echo $row1->ServiceName?></td>	
<td><?php echo "$".$subtotal=$row1->ServicePrice?></td>
</tr>

<?php
$gtotal+=$subtotal;
 $cnt=$cnt+1;}

} ?>

<tr>
<th colspan="2" style="text-align:center">Grand Total</th>
<th><?php echo "$".$gtotal?></th>	

</tr>
<tr>
<td>Upload Files</td>
<td><?php 
if (isset($_FILES['upload_file'])) {
	$uploads_dir = './uploads/'.strval($invid);
	$tmp_name = $_FILES["upload_file"]["tmp_name"];
	$name = basename($_FILES["upload_file"]["name"]);
	if (!@move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
		$error = error_get_last();
		echo $error['message'];
	}
}
?>
<form name="from_file_upload" action="" method="post"
	enctype="multipart/form-data">
	<div class="input-row">
		<input class="form-control" type="file" name="upload_file" accept=".jpg,.jpeg,.png,.pdf">
	</div>
	<input type="submit" name="upload" value="Upload File">
</form>

</td>
</tr>
<?php
if ($handle = opendir('./uploads/'.$invid)) {
while (false !== ($entry = readdir($handle))) {
	if ($entry != "." && $entry != "..") {
		$filename = str_replace(" 20", "xxx", $entry);
		$filename = str_replace(" ", "%", $filename);
		echo "<tr><td><u>".$entry."  "."</u><a href=delete-file.php?invoiceid=".$invid."&filename=".$filename.">Delete</a></td></tr>";
	}
}
closedir($handle);
}
?>
<tr>
<td colspan="2">
	<?php
	if (isset($_POST['btn_commnet'])) {
		$sql = "insert into `tbl_comments` (invid, comment, name) values('$invid','{$_POST['comment']}','{$_SESSION['login']}')";
		$query = $dbh -> prepare($sql);
		//$query->bindParam(':invid',$invid,PDO::PARAM_STR);
		$query->execute();
	}
	?>
<form name="comment_form" action="" method="post">
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Comments</span>
  </div>
  <textarea rows="3" cols="75" name="comment" calss="taclass" aria-label="Comments"></textarea><br>
  <input type="submit" name="btn_commnet" value="Send">
</div>
</form>
</td>
</tr>
<tr>
	<?php
	$sql = "select * from tbl_comments where invid=$invid";
	$query = $dbh -> prepare($sql);
	//$query->bindParam(':invid',$invid,PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	
	if($query->rowCount() > 0)
	{
	foreach($results as $row)
	{    
		echo "<tr><td>
		<b>Created At:</b> ".$row->comment_time." <b>Created By:</b> ".$row->name."<br>
		<b>Message:</b> ".$row->comment."</td></tr>";
	}
	}
	?>
</tr>

</table>
<p style="margin-top:1%"  align="center">
  <i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i>
</p>

							</div>

						</div>
				
					</div>
					<!--//graph-visual-->
				</div>
				<!--//outer-wp-->
				<?php include_once('includes/footer.php');?>
			</div>
		</div>
		<!--//content-inner-->
		<!--/sidebar-menu-->
		<?php include_once('includes/sidebar.php');?>
		<div class="clearfix"></div>		
	</div>
	<script>
		var toggle = true;

		$(".sidebar-icon").click(function() {                
			if (toggle)
			{
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({"position":"absolute"});
			}
			else
			{
				$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
				setTimeout(function() {
					$("#menu span").css({"position":"relative"});
				}, 400);
			}

			toggle = !toggle;
		});
	</script>
	<!--js -->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script>
function CallPrint(strid) {
var prtContent = document.getElementById("exampl");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
</body>
</html>
<?php }  ?>