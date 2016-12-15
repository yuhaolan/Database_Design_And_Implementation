<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);	

session_start();
$uid = $_SESSION['UID2'];
$password = $_SESSION['PSD2'];
echo '<h3>Welcome Staff '.$uid.'!<br></h3>';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$pid = trim($_POST['pid']);
	$anum = trim($_POST['anum']);
	$rent = trim($_POST['rent']);
	$av = trim($_POST['av']);
	$bed = trim($_POST['bed']);
	$bath = trim($_POST['bath']);
} 
else 
{
	echo "Something went wrong!";
}

$query = "select * from PropertyUnit where PropertyID = '$pid' and ApartmentNumber = '$anum';";

$result = mysql_query($query,$connect);

if($result && mysql_num_rows($result) > 0)
{
	echo "Please Update PropertyUnit<br>";
	$query1 = "update PropertyUnit 
	set Rent = '$rent',Availability='$av',NumberOfBedRoom='$bed',NumberOfBathRoom='$bath'
	where PropertyID = '$pid' and ApartmentNumber = '$anum';";
	$result1 = mysql_query($query1,$connect);
	if($result1)
	{
		echo "Update property Unit successfully!<br>";
	}
	else
	{
		echo "Failed";
	}
		
}
else
{
	echo "Please Add a Property Unit<br>";
	$query1 = "insert into PropertyUnit 
	values('$pid','$anum','$rent','$av','$bed',
	'$bath');";
	$result1 = mysql_query($query1,$connect);
	
	if($result1)
	{
		echo "Add PropertyUnit successfully!<br>";
	}
	else
	{
		echo "Failed";
	}
}
mysql_close($connect);




?>