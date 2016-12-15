<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);
//Returns the request method used to access the page (such as POST)
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$payamount = trim($_POST['Payamount']);
	$method = trim($_POST['method']);
	$uid = $_SESSION['UID'] ;


} 
else 
{
	echo "Something went wrong!";
}
//generate property id integer
//echo $payamount.'<br>';
//echo $method.'<br>';
$input = array(111,222,333);
$key = array_rand($input,1);
$pid = $input[$key];
//generate a transaction id  
$tid = rand(5, 99999999);
//generate a date
$today = date('Y-m-j');
//generate apartment number
$aid = rand(1,10);
//echo $today.'<br>';

//MakePayment (TenantUID,PropertyID,ApartmentNumber,TransactionID)
//1.       
	$query = "insert into Payment values('$tid','$method','$payamount','$today');";

	$result = mysql_query($query,$connect);

	if($result)
	{
		$query1 = "insert into MakePayment values('$uid',$pid,1,$tid);";
		$result1 = mysql_query($query1,$connect);
		if($result1)
		{
			
			echo "<h4>Update Pay Information Successfully!</h4><br>";
		}
		
	}


echo "<button onclick=\"javascript:history.go(-1)\">GO BACK</button>";



?>