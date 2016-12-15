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
$query = "select * from MaintainReq where ManagerUID = '$uid';";

$result = mysql_query($query,$connect);

if(!$result)
{
	echo mysql_error();
}
echo '
	<html><body>
	<table style="width:70%">
	<tr>
	<h3>Part One:View Maintenance Request in Manager!</h3>
	</tr>
	<tr>
	<td align = "left"><b>JobID</b></td>
	<td align = "left"><b>Date</b></td>
	<td align = "left"><b>RequestedJob</b></td>
	<td align = "left"><b>ManagerUID</b></td>
	<td align = "left"><b>PropertyID</b></td>
	<td align = "left"><b>ApartmentNumber</b></td>
	</tr>';
	
	
	while($entry = mysql_fetch_array($result))
	{
		echo '<tr><td align = "left"><b>'.$entry['JobID'].'</td>';
		echo '<td align="left"><b>'.$entry['Date'].'</td>';
		echo '<td align = "left"><b>'.$entry['RequestedJob'].'</td>';
		echo '<td align="left"><b>'.$entry['ManagerUID'].'</td>';
		echo '<td align="left"><b>'.$entry['PropertyID'].'</td>';
		echo '<td align="left"><b>'.$entry['ApartmentNumber'].'</td></tr>';
	}
	
	echo '</tables>
	</body>
	</html>
	';	
//==============================================================================

//VIEW PART TWO===============================================================

//==============================================================================
//==============================================================================
mysql_close($connect);




?>