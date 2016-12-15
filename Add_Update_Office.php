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
	$oid = trim($_POST['oid']);
	$phone = trim($_POST['phone']);
	$sname = trim($_POST['sname']);
	$snum = trim($_POST['snum']);
	$city = trim($_POST['city']);
	$state = trim($_POST['state']);
	$zip = trim($_POST['zip']);
} 
else 
{
	echo "Something went wrong!";
}

$query = "select * from Office where OfficeID = '$oid';";

$result = mysql_query($query,$connect);

if($result && mysql_num_rows($result) > 0)
{
	echo "Please Update Office<br>";
	$query1 = "update Office 
	set PhoneNumber = '$phone',StreetName='$sname',StreetNumber='$snum',City='$city',
	State = '$state',Zip = '$zip'
	where OfficeID = '$oid';";
	$result1 = mysql_query($query1,$connect);
	if($result1)
	{
		echo "Update Office successfully!<br>";
	}
	else
	{
		echo "Failed";
	}
		
}
else
{
	echo "Please Add a Office <br>";
	$query1 = "insert into Office 
	values('$oid','$phone','$sname','$snum','$city',
	'$state','$zip');";
	$result1 = mysql_query($query1,$connect);
	
	if($result1)
	{
		echo "Add Office successfully!<br>";
	}
	else
	{
		echo "Failed";
	}
}
mysql_close($connect);




?>