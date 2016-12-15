<?php
function Select($conn)
{
	$query = "SELECT UserID, FirstName, LastName, Email From User";
	$entries = mysql_query($query,$conn);
	
	if(!$entries)
	{
		echo mysql_error();
	}
	
	mysql_close($conn);
	return $entries;
}


function display($entries)
{
	echo '
	<html><body>
	<table align = "left" cellspacing="5" cellpadding = "8"
	<tr><td align = "left"><b>UserName</b></td>
	<td align = "left"><b>FirstName</b></td>
	<td align = "left"><b>LastName</b></td>
	<td align = "left"><b>Email</b></td></tr>';
	
	
	while($entry = mysql_fetch_array($entries))
	{
		echo '<td align = "left">'.$entry['UserID'].'</td>';
		echo '<td align="left">'.$entry['FirstName'].'</td>';
		echo '<td align="left">'.$entry['LastName'].'</td>';
		echo '<td align="left">'.$entry['Email'].'</td></tr>';
	}
	
	echo '</tables>
	</body>
	</html>';	
}
?>
