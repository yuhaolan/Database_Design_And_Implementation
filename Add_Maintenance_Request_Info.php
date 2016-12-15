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
	$date = trim($_POST['date']);
	$job = trim($_POST['job']);
	$pid = trim($_POST['pid']);
	$aid = trim($_POST['aid']);	
} 
else 
{
	echo "Something went wrong!!";
}
$jid = rand(15,10000);
//User (UserID,Password,FirstName,Lastname,Birthday,Email)
$query1 = "insert into MaintainReq values($jid,'$date','$job','$uid',$pid,$aid)";
//$query1 = "insert into User values ('$uid','$password','$fname','$lname','$birthday','$email')";
$result1 = mysql_query($query1,$connect);


$flag = 0;
if($result1)
{
	echo '========================<br>';
	echo 'Congratulations!!!!<br>';
	echo $uid.'  Add a new maintain request Successfully!!!!!<br>';
	$flag = 1;
}
else
{
	echo '========================<br>';
	echo 'Add Wrong!<br>';
}
echo '========================<br>';




mysql_close($connect);

?>