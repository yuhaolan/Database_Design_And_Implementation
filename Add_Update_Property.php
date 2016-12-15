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
	$pname = trim($_POST['pname']);
	$sname = trim($_POST['sname']);
	$snumber = trim($_POST['snumber']);
	$city = trim($_POST['city']);
	$state = trim($_POST['state']);
	$zip = trim($_POST['zip']);
	$mid = trim($_POST['mid']);


} 
else 
{
	echo "Something went wrong!";
}

$query = "select * from Property where PropertyID = '$pid';";

$result = mysql_query($query,$connect);

if($result && mysql_num_rows($result) > 0)
{
	echo "Please Update Property<br>";
	$query1 = "update Property 
	set PropertyName = '$pname',StreetName='$sname',StreetNumber='$snumber',City='$city',
	State='$state',Zip='$zip',ManagerUID='$mid'
	where PropertyID = '$pid'";
	$result1 = mysql_query($query1,$connect);
	if($result1)
	{
		echo "Update property successfully!<br>";
	}
	else
	{
		echo "Failed";
	}
		
}
else
{
	echo "Please Add a Property<br>";
	$query1 = "insert into Property 
	values('$pid','$pname','$sname','$snumber','$city',
	'$state','$zip','$mid');";
	$result1 = mysql_query($query1,$connect);
	
	if($result1)
	{
		echo "Add property successfully!<br>";
	}
	else
	{
		echo "Failed";
	}
}
mysql_close($connect);




?>