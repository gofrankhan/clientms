<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
 $eid=$_GET['editid'];
 $clientmsaid=$_SESSION['clientmsaid'];
 $TaxID=$_POST['TaxID'];
 $CustomerType=$_POST['CustomerType'];
 $FirstName=$_POST['FirstName'];
 $LastName=$_POST['LastName'];
 $CompanyName=$_POST['CompanyName'];
 $Dob=$_POST['Dob'];
 $pob=$_POST['pob'];
 $citizenship=$_POST['citizenship'];
 $Address1=$_POST['Address1'];
 $Address2=$_POST['Address2'];
 $City=$_POST['City'];
 $Region=$_POST['Region'];
 $PostCode=$_POST['PostCode'];
 $TelePhone=$_POST['TelePhone'];
 $Mobilephnumber=$_POST['Mobilephnumber'];
 
$sql="update tblclient set TaxID=:TaxID,CustomerType=:CustomerType,FirstName=:FirstName,LastName=:LastName,CompanyName=:CompanyName,Dob=:Dob,pob=:pob,citizenship=:citizenship,Address1=:Address1,Address2=:Address2,City=:City,Region=:Region,PostCode=:PostCode,TelePhone=:TelePhone,Mobilephnumber=:Mobilephnumber where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':acctid',$acctid,PDO::PARAM_STR);
$query->bindParam(':TaxID',$TaxID,PDO::PARAM_STR);
$query->bindParam(':CustomerType',$CustomerType,PDO::PARAM_STR);
$query->bindParam(':FirstName',$FirstName,PDO::PARAM_STR);
$query->bindParam(':LastName',$LastName,PDO::PARAM_STR);
$query->bindParam(':CompanyName',$CompanyName,PDO::PARAM_STR);
$query->bindParam(':Dob',$Dob,PDO::PARAM_STR);
$query->bindParam(':pob',$pob,PDO::PARAM_STR);
$query->bindParam(':citizenship',$citizenship,PDO::PARAM_STR);
$query->bindParam(':Address1',$Address1,PDO::PARAM_STR);
$query->bindParam(':Address2',$Address2,PDO::PARAM_STR);
$query->bindParam(':City',$City,PDO::PARAM_STR);
$query->bindParam(':Region',$Region,PDO::PARAM_STR);
$query->bindParam(':PostCode',$PostCode,PDO::PARAM_STR);
$query->bindParam(':TelePhone',$TelePhone,PDO::PARAM_STR);
$query->bindParam(':Mobilephnumber',$Mobilephnumber,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
echo '<script>alert("Client detail has been updated")</script>';
echo "<script type='text/javascript'> document.location ='manage-client.php'; </script>";
  }
  ?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Client Management Sysytem|| Update Clients</title>

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
	<!-- //lined-icons -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<!--clock init-->
	<script src="js/css3clock.js"></script>
	<!--Easy Pie Chart-->
	<!--skycons-icons-->
	<script src="js/skycons.js"></script>
	<!--//skycons-icons-->
</head> 
<body>
<div class="page-container">
<!--/content-inner-->
<div class="left-content">
<div class="inner-content">
	
<?php //include_once('includes/header.php');?>
				<!--//outer-wp-->
<div class="outter-wp">
					<!--/sub-heard-part-->
<div class="sub-heard-part">
<ol class="breadcrumb m-b-0">
<li><a href="dashboard.php">Home</a></li>
<li class="active">View Clients</li>
</ol>
</div>	
					<!--/sub-heard-part-->	
					<!--/forms-->
<div class="forms-main">
<h2 class="inner-tittle">Clients Profile</h2>
<div class="graph-form">
<div class="form-body">
<form method="post"> 
	<?php
$eid=$_GET['editid'];
$sql="SELECT * from tblclient where ID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
	
	<table class="table table-bordered" style="width:50%">
	
					<tbody>
					  <tr>
						<td>TAX ID</td>
						<td><?php  echo $row->TaxID;?></td>
					  </tr>
					  
					  <tr>
					  
						<td>CUSTOMER TYPES</td>
						<td><?php  echo $row->CustomerType;?></td>
					  </tr>
					  
					  <tr>					  
						<td>FIRST NAME</td>
						<td><?php  echo $row->FirstName;?></td>
					  </tr>
					  
					  <tr>					  
						<td>LAST NAME</td>
						<td><?php  echo $row->LastName;?></td>
					  </tr>
					  
					  <tr>
						<td>COMPNAY NAME</td>
						<td><?php  echo $row->CompanyName;?></td>
					  </tr>
					  
					  <tr>
						<td>TELEPHONE</td>
						<td><?php  echo $row->TelePhone;?></td>
					  </tr>
					  
					  <tr>
						<td>MOBILE</td>
						<td><?php  echo $row->Mobilephnumber;?></td>
					  </tr>
					  
					  <tr>
						<td>DATE OF BIRTH</td>
						<td><?php  echo $row->Dob;?></td>
					  </tr>
					  
					  <tr>
						<td>PLACE OF BIRTH</td>
						<td><?php  echo $row->pob;?></td>
					  </tr>
					  
					  <tr>
						<td>CITYZENSHIP</td>
						<td><?php  echo $row->citizenship;?></td>
					  </tr>
					  
					  <tr>
						<td>ADDRESS LINE 1</td>
						<td><?php  echo $row->Address1;?></td>
					  </tr>
					  
					  <tr>
						<td>ADDRESS LINE 2</td>
						<td><?php  echo $row->Address2;?></td>
					  </tr>
					  
					  <tr>
						<td>CITY</td>
						<td><?php  echo $row->City;?></td>
					  </tr>
					  
					  <tr>
						<td>REGION</td>
						<td><?php  echo $row->Region;?></td>
					  </tr>
					  
					  <tr>
						<td>POSTCODE</td>
						<td><?php  echo $row->PostCode;?></td>
					  </tr>
					  
					</tbody>
				  </table>
	<?php $cnt=$cnt+1;}} ?>
	 <input type="button" class="btn btn-default" value="Back" onClick="history.back();return true;"> </form> 
</div>
</div>
</div> 
</div>
<?php include_once('includes/footer.php');?>
</div>
</div>		
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
</body>
</html>
<?php }  ?>