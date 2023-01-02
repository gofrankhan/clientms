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
 $Email=$_POST['Email'];
 $WebsiteAddress=$_POST['WebsiteAddress'];
 $Notes=$_POST['Notes'];
 
$sql="update tblclient set TaxID=:TaxID,CustomerType=:CustomerType,FirstName=:FirstName,LastName=:LastName,CompanyName=:CompanyName,Dob=:Dob,pob=:pob,citizenship=:citizenship,Address1=:Address1,Address2=:Address2,City=:City,Region=:Region,PostCode=:PostCode,TelePhone=:TelePhone,Mobilephnumber=:Mobilephnumber,Email=:Email,WebsiteAddress=:WebsiteAddress,Notes=:Notes where ID=:eid";
$query=$dbh->prepare($sql);
//$query->bindParam(':acctid',$acctid,PDO::PARAM_STR);
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
$query->bindParam(':Email',$Email,PDO::PARAM_STR);
$query->bindParam(':WebsiteAddress',$WebsiteAddress,PDO::PARAM_STR);
$query->bindParam(':Notes',$Notes,PDO::PARAM_STR);
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
<li class="active">Update Clients</li>
</ol>
</div>	
					<!--/sub-heard-part-->	
					<!--/forms-->
<div class="forms-main">
<h2 class="inner-tittle">Update Clients </h2>
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
	<div class="form-group"> <label for="exampleInputEmail1">TAX ID</label> <input type="text" name="TaxID" value="<?php  echo $row->TaxID;?>" class="form-control" required='true'> </div>							
	<div class="form-group"> <label for="exampleInputEmail1">Customer Type</label> <select type="text" name="CustomerType" class="form-control" required='true'>
		<option value="<?php echo htmlentities($row->CustomerType);?>"><?php echo htmlentities($row->CustomerType);?></option>
		<option value="Person">Person</option>
		<option value="Company">Company</option>		
	</select> </div>
	<div class="form-group"> <label for="exampleInputEmail1">First Name</label> <input type="text" name="FirstName" value="<?php  echo $row->FirstName;?>" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Last Name</label> <input type="text" name="LastName" value="<?php  echo $row->LastName;?>" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Company Name</label> <input type="text" name="CompanyName" value="<?php  echo $row->CompanyName;?>" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Date of Birth</label> <input type="date" name="Dob" value="<?php  echo $row->Dob;?>" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Place of Birth</label> <input type="text" name="pob" value="<?php  echo $row->pob;?>" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Cityzenship</label> <input type="text" name="citizenship" value="<?php  echo $row->citizenship;?>" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Address Line1</label> <textarea type="text" name="Address1"  class="form-control" required='true' rows="4" cols="3"><?php  echo $row->Address1;?></textarea> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Address Line2</label> <textarea type="text" name="Address2"  class="form-control" required='true' rows="4" cols="3"><?php  echo $row->Address2;?></textarea> </div>
	<div class="form-group"> <label for="exampleInputEmail1">City</label> <input type="text" name="City" value="<?php  echo $row->City;?>" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Region</label> <input type="text" name="Region" value="<?php  echo $row->Region;?>" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Post Code</label> <input type="text" name="PostCode" value="<?php  echo $row->PostCode;?>" class="form-control" required='true'> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Tele Phone Number</label><input type="text" name="TelePhone" value="<?php  echo $row->TelePhone;?>" class="form-control" maxlength='10' required='true' pattern="[0-9]+"> </div>
	<div class="form-group"> <label for="exampleInputEmail1">Cell Phone Number</label><input type="text" name="Mobilephnumber" value="<?php  echo $row->Mobilephnumber;?>" class="form-control" maxlength='10' pattern="[0-9]+"> </div>
	<div class="form-group"> <label for="exampleInputPassword1">Creation Date</label> <input type="text" name="" value="<?php  echo $row->CreationDate;?>" required='true' class="form-control" readonly='true'> </div>
	<?php $cnt=$cnt+1;}} ?>
	 <button type="submit" class="btn btn-default" name="submit" id="submit">Update</button><input type="button" class="btn btn-default" value="Back" onClick="history.back();return true;"> </form> 
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