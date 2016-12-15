<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);
//Returns the request method used to access the page (such as POST)

session_start();
$uid = $_SESSION['UID1'];
$password = $_SESSION['PSD1'];
echo '<h3>Welcome Manager '.$uid.'!<br></h3>';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$uid1 = trim($_POST['uid']);
	$eid = trim($_POST['eid']);
	$password1 = trim($_POST['password']);
	$jid = trim($_POST['jid']);
	$aid = trim($_POST['aid']);	
} 
else 
{
	echo "Something went wrong!!";
}
$flag == 0;
//User (UserID,Password,FirstName,Lastname,Birthday,Email)
if( (strcmp($uid,$uid1) == 0) && (strcmp($password,$password1) == 0))
{
	echo "uid and password match!<br>";
	$query = "select * from Manager where EmployeeID = '$eid';";
	$result = mysql_query($query,$connect);
	if($result && mysql_num_rows($result) > 0 )
	{
		$flag = 1;
	}
	else
	{
		echo "eid is wrong<br>";
	}

}
else
{
	echo "uid and password not match!<br>";
}
if ($flag == 1)
{
	$query1 = "delete from MaintainReq where JobID = '$jid';";
	$result1 = mysql_query($query1,$connect);
}



if($result1)
{
	echo '========================<br>';
	echo 'Congratulations!!!!<br>';
	echo $uid.'  Delete a maintain request Successfully!!!!!<br>';
}
else
{
	echo '========================<br>';
	echo 'Delete Wrong!<br>';
}
echo '========================<br>';




mysql_close($connect);

?>