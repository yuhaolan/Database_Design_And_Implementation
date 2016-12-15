<?php

function add($num1, $num2)
{
	return $num1 + $num2;
}

function subtract($num1, $num2)
{
	return $num1 - $num2;
}

function mainp($num1, $num2, $option)
{
	if($option == "add")
		
		$res = add($num1,$num2);
	else	
		$res = subtract($num1, $num2);
	echo $res;
}

mainp(1,10,"add");

?>
