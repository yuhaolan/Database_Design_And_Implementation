<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);
//Returns the request method used to access the page (such as POST)
	
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$tid = trim($_POST['tid']);
	$pid = trim($_POST['pid']);
	$an = trim($_POST['an']);

} 
else 
{
	echo "Something went wrong!";
}

$startdate = date('Y-m-j');
$enddate='2018-12-31';


$query0 = "select * from StayIn where TenantUID = '$tid'";
$result0 = mysql_query($query0,$connect);
	
$flag = 1;	
if($result0 && mysql_num_rows($result0) > 0)
{
	echo "Tenant alreay has a property!<br>";
	$flag = 0;
}
else
{
	echo "Tenant  don't a property!<br>";
}

$query1 = "select * from PropertyUnit where PropertyID = '$pid' 
and Availability = 'Y' and ApartmentNumber = '$an';";
//echo $query1;

$result1 = mysql_query($query1,$connect);
if($result1 && mysql_num_rows($result1) > 0)
{
	echo "Property is availiable !<br>";
}
else
{
	echo "Property is not availiable !<br>";
	$flag = 0;
}
//======
if($flag)
{
	$query2 = 
		"insert into StayIn 
		values('$tid','$startdate','$pid','$an','$enddate');";

	$result2 = mysql_query($query2,$connect);
	if($result2)
	{
		echo "Update StayIn!<br>";	
	}
	else
	{
		echo "Insert in StayIn wrong!<br>";
	}
	$query3 = 
		"update PropertyUnit
		set Availability = 'N'
		where PropertyID = '$pid' and ApartmentNumber = '$an';";
		
		
	$result3 = mysql_query($query3,$connect);
	
	if($result3)
	{
		echo "Update PropertyUnit!<br>";
		echo "RUN SUCCESSFULLY~~~~~~~~~~~~<br>";

	}
	else
	{
		echo "Update PropertyUnit WRONG<br>";
	}
}
	



echo "<button onclick=\"javascript:history.go(-1)\">GO BACK</button>";



?>