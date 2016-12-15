<?php
include('Connection.php');
include('Constants.php');
include('SelectQuery.php');

$conn = GetConnection($DBUser, $DBpass, $DBHost, $DBname);

$entries = Select($conn);

display($entries);
?>

