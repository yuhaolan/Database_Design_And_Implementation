<?php
function GetTenantsFromProperty($managerUID,$conn)
{

	$query = "Select TenantID, LivesIn.PropertyID, LivesIn.ApartmentNumber from Tenant,LivesIn,PropertyUnits where 
	Tenant.UserID = LivesIn.TenantUID AND LivesIn.PropertyID = PropertyUnits.PropertyID AND 
	LivesIn.ApartmentNumber = PropertyUnits.ApartmentNumber AND PropertyUnits.ManagerUID = '$managerUID'";
	
	$entries = mysql_query($query,$conn);
	
	if(!$entries)
	{
		echo mysql_error();
	}
	
	mysql_close($conn);
	
	return $entries;
}

function displayADV($entries)
{	
	echo '
	<html><body>
	<table align = "left" cellspacing="5" cellpadding = "8"
	<tr><td align = "left"><b>TenantID</b></td>
	<td align = "left"><b>PropertyID</b></td>
	<td align = "left"><b>ApartmentNumber</b></td></tr>';
	
	
	while($entry = mysql_fetch_array($entries))
	{
		echo '<td align = "left">'.$entry['TenantID'].'</td>';
		echo '<td align="left">'.$entry['PropertyID'].'</td>';
		echo '<td align="left">'.$entry['ApartmentNumber'].'</td></tr>';
	}
	
	echo '</tables>
	</body>
	</html>';	
}

include('Connection.php');
include('Constants.php');
$conn = GetConnection($DBUser, $DBpass, $DBHost, $DBname);
$managerUID = "johnsmith";
$entries = GetTenantsFromProperty($managerUID,$conn);
displayADV($entries);
?>
