<?php
echo "1234567";

$DBUser = 'lanyuhao';
$DBpass = 'lan5yu78hao';
$DBHost = 'dbclass2.cs.nmsu.edu';
$DBname = 'cs502lanyuhao';

function GetConnection($DBUser, $DBpass, $DBHost, $DBname)
{
	echo "1";
	$conn = mysql_connect($DBHost,$DBUser,$DBpass);
	if(!$conn)
	{
		die('Could not connect:' . mysql_error());
	}
	echo 'Connected server successfully';
	echo "2";
	if(!mysql_select_db($DBname,$conn))
	{
		echo mysql_error();
	}
	echo "3";
	echo 'Connected cs502lanyuhao successfully';
	return $conn;
}
/*
$link = mysql_connect('dbclass2.cs.nmsu.edu', 'lanyuhao', 'lan5yu78hao');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_close($link);
*/
GetConnection($DBUser, $DBpass, $DBHost, $DBname);

?>
