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
	$jid = trim($_POST['jid']);
	$date = trim($_POST['date']);
	$job = trim($_POST['job']);
	$pid = trim($_POST['pid']);
	$aid = trim($_POST['aid']);	
} 
else 
{
	echo "Something went wrong!!";
}
//User (UserID,Password,FirstName,Lastname,Birthday,Email)

$query1 = "update MaintainReq 
set Date ='$date',
RequestedJob = '$job',
PropertyID = '$pid',       
ApartmentNumber = '$aid'
where JobID = '$jid';";
$result1 = mysql_query($query1,$connect);


$flag = 0;
if($result1)
{
	echo '========================<br>';
	echo 'Congratulations!!!!<br>';
	echo $uid.'  Upate a maintain request Successfully!!!!!<br>';
	$flag = 1;
}
else
{
	echo '========================<br>';
	echo 'Upate Wrong!<br>';
}
echo '========================<br>';




mysql_close($connect);

?>