<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);
//Returns the request method used to access the page (such as POST)
	
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$uid = trim($_POST['uid']);
	$eid = trim($_POST['eid']);
	$psd1 = trim($_POST['password1']);
	$psd2 = trim($_POST['password2']);
	$email = trim($_POST['email']);
	$phnum = trim($_POST['phonennumber']);


} 
else 
{
	echo "Something went wrong!";
}

if($psd1 != $psd2)
{
	echo "<h4>Password1 is not mathched with password2!</h4><br>";
}
else
{
	$query0 = "select * from Staff where EmployeeID = '$eid'";
	$result0 = mysql_query($query0,$connect);
	$query = "select * from User where UserID = '$uid'";
	$result = mysql_query($query,$connect);
	
	if($result && $result0 && mysql_num_rows($result) > 0 && mysql_num_rows($result0) > 0)
	{
		$query1 =                            
		"update User 
		set Password='$psd1',Email='$email'
		where UserID = '$uid';";

		$result1 = mysql_query($query1,$connect);
	
		$query2 = 
		"update UserPhoneNumber 
		set PhoneNumber='$phnum'
		where UserID = '$uid';";
		$result2 = mysql_query($query2,$connect);
		
		echo "<h4>Update Staff Information Successfully!</h4><br>";
		echo "<h4>Your UserID is '$uid'</h4><br>";
		echo "<h4>Your Password is '$psd1'</h4><br>";
		echo "<h4>Please remember it</h4><br>";



	}
	else
	{
		echo "UserID didn't find in the Staff!<br>";
	}
		
	
	
}



echo "<button onclick=\"javascript:history.go(-1)\">GO BACK</button>";



?>