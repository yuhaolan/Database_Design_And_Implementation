<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);	

session_start();
$uid = $_SESSION['UID'];
$password = $_SESSION['PSD'];
echo '<h3>Welcome Tenant '.$uid.'!<br></h3>';

//VIEW PART ONE===============================================================
//User (UserID,Password,FirstName,Lastname,Birthday,Email)
//echo '<h2>Part One:View information in StayIn!</h2>';
//StayIn (TenantUID,StartDate,PropertyID,ApartmentNumber,EndDate)
$query = "select * from StayIn where TenantUID = '$uid';";

$result = mysql_query($query,$connect);

if(!$result)
{
	echo mysql_error();
}
echo '
	<html><body>
	<table style="width:50%">
	<tr>
	<h3>Part One:View information in StayIn!</h3>
	</tr>
	<tr>
	<td align = "left"><b>TenantUID</b></td>
	<td align = "left"><b>StartDate</b></td>
	<td align = "left"><b>PropertyID</b></td>
	<td align = "left"><b>ApartmentNumber</b></td>
	<td align = "left"><b>EndDate</b></td>
	</tr>';
	
	
	while($entry = mysql_fetch_array($result))
	{
		echo '<tr><td align = "left"><b>'.$entry['TenantUID'].'</td>';
		echo '<td align="left"><b>'.$entry['StartDate'].'</td>';
		echo '<td align="left"><b>'.$entry['PropertyID'].'</td>';
		echo '<td align = "left"><b>'.$entry['ApartmentNumber'].'</td>';
		echo '<td align="left"><b>'.$entry['EndDate'].'</td></tr>';
	}
	
	echo '</tables>
	</body>
	</html>
	';	
//==============================================================================

//VIEW PART TWO===============================================================

//echo '<h2>Part Two:View information in MakePayment and Payment!</h2>';
$query = "select * from Payment NATURAL JOIN MakePayment where TenantUID = '$uid';";

$result = mysql_query($query,$connect);

if(!$result)
{
	echo mysql_error();
}
echo '
	<html><body>
	<table style="width:70%">
	<tr>
	<h3>Part Two:View information in Payment and Makepayment!</h3>
	</tr>
	<tr>
	<td align = "left"><b>TransactionID</b></td>
	<td align = "left"><b>PaymentMethod</b></td>
	<td align = "left"><b>Amount</b></td>
	<td align = "left"><b>Date</b></td>
	<td align = "left"><b>TenantUID</b></td>
	<td align = "left"><b>PropertyID</b></td>
	<td align = "left"><b>ApartmentNumber</b></td>
	<td align = "left"><b>TransactionID</b></td>
	</tr>';
	
	
	while($entry = mysql_fetch_array($result))
	{
		echo '<tr>
		<td align = "left"><b>'.$entry['TransactionID'].'</td>';
		echo '<td align="left"><b>'.$entry['PaymentMethod'].'</td>';
		echo '<td align="left"><b>'.$entry['Amount'].'</td>';
		echo '<td align="left"><b>'.$entry['Date'].'</td>';
		echo '<td align="left"><b>'.$entry['TenantUID'].'</td>';
		echo '<td align="left"><b>'.$entry['PropertyID'].'</td>';
		echo '<td align = "left"><b>'.$entry['ApartmentNumber'].'</td>';
		echo '<td align="left"><b>'.$entry['TransactionID'].'</td>
		</tr>';
	}
	
	echo '</tables>
	</body>
	</html>
	';	
//==============================================================================
//VIEW PART THREE===============================================================
$query = "select ManagerUID,TenantUID,PropertyID,OfficeID,PhoneNumber,Office.StreetName,Office.StreetNumber,Office.City,Office.State,Office.Zip 
from (StayIn natural join PropertyUnit natural join Property),(Manager natural join Office) 
where TenantUID = '$uid' and Manager.UserID = Property.ManagerUID;";

$result = mysql_query($query,$connect);

if(!$result)
{
	echo mysql_error();
}
echo '
	<html><body>
	<table style="width:80%">
	<tr>
	<h3>Part Three:View information in manager fo property unit,office!</h3>
	</tr>
	<tr>
	<td align = "left"><b>ManagerUID</b></td>
	<td align = "left"><b>TenantUID</b></td>
	<td align = "left"><b>PropertyID</b></td>
	<td align = "left"><b>OfficeID</b></td>
	<td align = "left"><b>PhoneNumber</b></td>
	<td align = "left"><b>Office.StreetName</b></td>
	<td align = "left"><b>Office.StreetNumber</b></td>
	<td align = "left"><b>Office.City</b></td>
	<td align = "left"><b>Office.State</b></td>
	<td align = "left"><b>Office.Zip</b></td>
	</tr>';
	
	
	while($entry = mysql_fetch_array($result))
	{
		echo '<tr>
		<td align = "left"><b>'.$entry['ManagerUID'].'</td>';
		echo '<td align="left"><b>'.$entry['TenantUID'].'</td>';
		echo '<td align="left"><b>'.$entry['PropertyID'].'</td>';
		echo '<td align="left"><b>'.$entry['OfficeID'].'</td>';
		echo '<td align="left"><b>'.$entry['PhoneNumber'].'</td>';
		echo '<td align="left"><b>'.$entry['StreetName'].'</td>';
		echo '<td align="left"><b>'.$entry['StreetNumber'].'</td>';
		echo '<td align="left"><b>'.$entry['City'].'</td>';
		echo '<td align="left"><b>'.$entry['State'].'</td>';
		echo '<td align="left"><b>'.$entry['Zip'].'</td>
		</tr>';
	}
	
	echo '</tables>
	</body>
	</html>
	';	
//==============================================================================
mysql_close($connect);



?>