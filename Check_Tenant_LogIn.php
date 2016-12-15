<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);
//Returns the request method used to access the page (such as POST)
session_start();
	        
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$uid = trim($_POST['UserID']);
	$password = trim($_POST['password']);
	//pass to the lower files
	$_SESSION['UID'] = $uid;
	$_SESSION['PSD'] = $password;
	
} 
else 
{
	echo "Something went wrong!!";
}

//User (UserID,Password,FirstName,Lastname,Birthday,Email)
$query1 = "select UserID,Password from User where UserID = '$uid' and Password = '$password';";
//$query1 = "insert into User values ('$uid','$password','$fname','$lname','$birthday','$email')";

$result1 = mysql_query($query1,$connect);

$query2 = "select UserID from Tenant where UserID = '$uid';";
$result2 = mysql_query($query2,$connect);

$flag = 0;
if($result1 && $result2  && mysql_num_rows($result1) > 0 && mysql_num_rows($result2) > 0 )
{
	echo '========================<br>';
	echo 'Congratulations!!!!<br>';
	echo $uid.'  LogIn Successfully!!!!!<br>';
	$flag = 1;
}
else
{
	echo '========================<br>';
	echo 'Username and Password NOT Found!<br>';
}
echo '========================<br>';

if($flag)
{
	header('Location: http://www.cs.nmsu.edu/~yulan/Edit_Tenant.html');


	
}


mysql_close($connect);

?>