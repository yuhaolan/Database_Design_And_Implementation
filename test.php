<?php
echo "1122334455"."</td>";
echo "~~!!!~~~";
echo "Add a new line \n";  

$conn = mysql_connect('dbclass2.cs.nmsu.edu','lanyuhao','lan5yu78hao');
        if(!$conn)
        {
                die('Could not connect:' . mysql_error());
        }
        echo 'Connected server successfully';
?>
