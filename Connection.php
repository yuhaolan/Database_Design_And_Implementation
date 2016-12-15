<?php

function GetConnection($DBUser, $DBpass, $DBHost, $DBname)
{
	
	$conn = mysql_connect($DBHost,$DBUser,$DBpass);
	if(!$conn)
        {
                die('Could not connect:' . mysql_error());
        }
        echo 'Connected server successfully.<br>';
	if(!mysql_select_db($DBname,$conn))
	{
		echo mysql_error();
	}
	echo 'Connected database successfully.<br>';
	return $conn;
}
?>
