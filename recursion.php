<?php

$arr = array(15,2,3,4,99,1,1);

echo sum($arr);
echo recursiveSum($arr);
echo getMax($arr);

function sum($arr) {
	$result = 0;

	foreach ($arr as $value) {
		$result += $value;
	}

	return $result;
}

function getMax($arr) {
	$max = 0;

	foreach ($arr as $value) {
		if ($value > $max) {
			$max = $value;
		}
	}

	return $max;
}

function recursiveSum($arr) {
	$result = 0;

	if (empty($arr)) {
		return $result;
	}
	
	$result += $arr[0];

	unset($arr[0]);

	return $result + sum(array_values($arr));
}
