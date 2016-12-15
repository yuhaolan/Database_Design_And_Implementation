<?php
include('Connection.php');
include('Constants.php');

$connect = GetConnection($DBUser, $DBpass, $DBHost, $DBname);
//Returns the request method used to access the page (such as POST)
	

	$query = "select UserID from Tenant where UserID not in (select TenantUID from StayIn) ;";
	$result = mysql_query($query,$connect);
	
	if($result && mysql_num_rows($result) > 0 )
	{
		echo '
	<html><body>
	<table style="width:70%">
	<tr>
	<h3>Show the Tenant who did not have property!</h3>
	</tr>
	<tr>
	<td align = "left"><b>UserID</b></td>
	</tr>';
	
	
	while($entry = mysql_fetch_array($result))
	{
		echo '<tr><td align = "left"><b>'.$entry['UserID'].'</td></tr>';
	}
	
	echo '</tables>
	</body>
	</html>
	';	
		
	}
	else
	{
		echo "FAILED";
	}
	
	$query1 = "select * from StayIn;";
	$result1 = mysql_query($query1,$connect);
	
	if($result1 && mysql_num_rows($result1) > 0 )
	{
		echo '
	<html><body>
	<table style="width:70%">
	<tr>
	<h3>Show the Tenant who did have property!</h3>
	</tr>
	<tr>
	<td align = "left"><b>UserID</b></td>
	<td align = "left"><b>StartDate</b></td>
	<td align = "left"><b>PropertyID</b></td>
	<td align = "left"><b>ApartmentNumber</b></td>
	<td align = "left"><b>EndDate</b></td>

	</tr>';
	
	
	while($entry = mysql_fetch_array($result1))
	{
		echo '<tr>
		<td align = "left"><b>'.$entry['TenantUID'].'</td>
		<td align = "left"><b>'.$entry['StartDate'].'</td>
		<td align = "left"><b>'.$entry['PropertyID'].'</td>
		<td align = "left"><b>'.$entry['ApartmentNumber'].'</td>
		<td align = "left"><b>'.$entry['EndDate'].'</td>		
		</tr>';
	}
	
	echo '</tables>
	</body>
	</html>
	';	
		
	}
	else
	{
		echo "FAILED";
	}


	$query2 = "select * from PropertyUnit where Availability = 'Y';";
	$result2 = mysql_query($query2,$connect);
	
	if($result2 && mysql_num_rows($result2) > 0 )
	{
		echo '
	<html><body>
	<table style="width:70%">
	<tr>
	<h3>Show the Availiable property unit!</h3>
	</tr>
	<tr>
	<td align = "left"><b>PropertyID</b></td>
	<td align = "left"><b>ApartmentNumber</b></td>
	<td align = "left"><b>Rent</b></td>
	<td align = "left"><b>Availability</b></td>
	<td align = "left"><b>NumberOfBedRoom</b></td>
	<td align = "left"><b>NumberOfBathRoom</b></td>

	</tr>';
	
	
	while($entry = mysql_fetch_array($result2))
	{
		echo '<tr>
		<td align = "left"><b>'.$entry['PropertyID'].'</td>
		<td align = "left"><b>'.$entry['ApartmentNumber'].'</td>
		<td align = "left"><b>'.$entry['Rent'].'</td>
		<td align = "left"><b>'.$entry['Availability'].'</td>
		<td align = "left"><b>'.$entry['NumberOfBedRoom'].'</td>
		<td align = "left"><b>'.$entry['NumberOfBathRoom'].'</td>		
		</tr>';
	}
	
	echo '</tables>
	</body>
	</html>
	';	
		
	}
	else
	{
		echo "FAILED";
	}	




echo "<button onclick=\"javascript:history.go(-1)\">GO BACK</button>";



?>