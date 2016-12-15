<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);	

session_start();
$uid = $_SESSION['UID1'];
$password = $_SESSION['PSD1'];
echo '<h3>Welcome Manager '.$uid.'!<br></h3>';

//VIEW PART ONE===============================================================
//User (UserID,Password,FirstName,Lastname,Birthday,Email)
//echo '<h2>Part One:View information in StayIn!</h2>';
//StayIn (TenantUID,StartDate,PropertyID,ApartmentNumber,EndDate)
$query = "select * from User NATURAL JOIN Manager where UserID = '$uid';";

$result = mysql_query($query,$connect);

if(!$result)
{
	echo mysql_error();
}
echo '
	<html><body>
	<table style="width:70%">
	<tr>
	<h3>Part One:View information in Manager!</h3>
	</tr>
	<tr>
	<td align = "left"><b>UserID</b></td>
	<td align = "left"><b>EmployeeID</b></td>
	<td align = "left"><b>Password</b></td>
	<td align = "left"><b>FirstName</b></td>
	<td align = "left"><b>LastName</b></td>
	<td align = "left"><b>Birthday</b></td>
	<td align = "left"><b>Email</b></td>
	</tr>';
	
	
	while($entry = mysql_fetch_array($result))
	{
		echo '<tr><td align = "left"><b>'.$entry['UserID'].'</td>';
		echo '<td align="left"><b>'.$entry['EmployeeID'].'</td>';
		echo '<td align = "left"><b>'.$entry['Password'].'</td>';
		echo '<td align="left"><b>'.$entry['FirstName'].'</td>';
		echo '<td align="left"><b>'.$entry['Lastname'].'</td>';
		echo '<td align = "left"><b>'.$entry['Birthday'].'</td>';
		echo '<td align="left"><b>'.$entry['Email'].'</td></tr>';
	}
	
	echo '</tables>
	</body>
	</html>
	';	
//==============================================================================

//VIEW PART TWO===============================================================

//echo '<h2>Part Two:View information in MakePayment and Payment!</h2>';
$query = "
select Staff.OfficeID,Office.PhoneNumber AS OfficePhonenumber,StreetName,StreetNumber,City,State,Zip,
Staff.EmployeeID AS StaffEmployID,UserPhoneNumber.PhoneNumber AS StaffPhoneNumber 
from (Manager NATURAL JOIN Office),(Staff NATURAL JOIN UserPhoneNumber) 
where Manager.UserID = '$uid' and Manager.OfficeID = Staff.OfficeID LIMIT 1;";

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
	<td align = "left"><b>OfficeID</b></td>
	<td align = "left"><b>OfficePhonenumber</b></td>
	<td align = "left"><b>StreetName</b></td>
	<td align = "left"><b>StreetNumber</b></td>
	<td align = "left"><b>City</b></td>
	<td align = "left"><b>State</b></td>
	<td align = "left"><b>Zip</b></td>
	<td align = "left"><b>StaffEmployID</b></td>
	<td align = "left"><b>StaffPhoneNumber</b></td>
	</tr>';
	
	
	while($entry = mysql_fetch_array($result))
	{
		echo '<tr>
		<td align = "left"><b>'.$entry['OfficeID'].'</td>';
		echo '<td align="left"><b>'.$entry['OfficePhonenumber'].'</td>';
		echo '<td align="left"><b>'.$entry['StreetName'].'</td>';
		echo '<td align="left"><b>'.$entry['StreetNumber'].'</td>';
		echo '<td align="left"><b>'.$entry['City'].'</td>';
		echo '<td align="left"><b>'.$entry['State'].'</td>';
		echo '<td align="left"><b>'.$entry['Zip'].'</td>';
		echo '<td align="left"><b>'.$entry['StaffEmployID'].'</td>';
		echo '<td align="left"><b>'.$entry['StaffPhoneNumber'].'</td>
		</tr>';
	}
	
	echo '</tables>
	</body>
	</html>
	';	
//==============================================================================
//==============================================================================
mysql_close($connect);




?>