<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);
//Returns the request method used to access the page (such as POST)
	
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$uid = trim($_POST['UserID']);
	$fname = trim($_POST['fname']);
	$lname = trim($_POST['lname']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$birthday = trim($_POST['birthday']);


} 
else 
{
	echo "Something went wrong!!";
}
$flag = 1;
 //check the length of each variable
if (strlen($uid) < 8 || strlen($uid) >= 16)
{
	echo 'UID must be more than 8 characters and less than 16';
	header('Location: http://www.cs.nmsu.edu/~yulan/SignIn.html');
	$flag = 0;
	exit;
}
//check email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  echo("$email is a valid email address<br>");
} else {
  echo("$email is not a valid email address");
  header('Location: http://www.cs.nmsu.edu/~yulan/SignIn.html');

}
//assign a unique Tenant id
$six_digit_random_number = mt_rand(100000, 999999);
$tid = (string) $six_digit_random_number;
//now insert data into database
//insert into User (UserID,Password,FirstName,Lastname,Birthday,Email)
$query1 = "insert into User values ('$uid','$password','$fname','$lname','$birthday','$email');";
if(mysql_query($query1,$connect))
{
	echo 'Insert Into User Successfully~~~~~~~.<br>';
//display input variables

} 
else 
{
	echo 'ERROR IN INPUT DATA: <br>';
	echo mysql_error();

	
}
//insert into Tenant (UserID,TenantID)
$query2 = "insert into Tenant values ('$uid','$tid')";
if(mysql_query($query2,$connect))
{
	echo 'Insert Into Tenant Successfully~~~~~~.<br>';
	echo '
	<html><body>
	<p><font size ="7">Show the input data:</font></p>
	<table align = "left" cellspacing="5" cellpadding = "8"
	<tr><td align = "left"><b>UserID</b></td>
	<td align = "left"><b>FirstName</b></td>
	<td align = "left"><b>LastName</b></td>
	<td align = "left"><b>Password</b></td>
	<td align = "left"><b>Email</b></td>
	<td align = "left"><b>Birthday</b></td></tr>
	 <br>';

	echo '<td align = "left">'.$uid.'</td>';
	echo '<td align="left">'.$fname.'</td>';
	echo '<td align="left">'.$lname.'</td>';
	echo '<td align="left">'.$password.'</td>';
	echo '<td align="left">'.$email.'</td>';
	echo '<td align = "left">'.$birthday.'</td>';
	echo '<br>';
	mysql_close($connect);


}
else
{
	echo 'ERROR IN INPUT INTO Tenant<br>';
	echo mysql_error();
	mysql_close($connect); 
	echo ".<br>";

}

echo "<button onclick=\"javascript:history.go(-1)\">GO BACK</button>";


?>
