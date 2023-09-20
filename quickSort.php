<?php

$arr = array(3,2,1,4,4,6,3,5);

echo "<pre>";
print_r(quickSort($arr));

function quickSort($arr) {
	if (count($arr) < 2) {
		return $arr;
	}
	
	$lessThan = array();
	$moreThan = array();
	$refIndex = rand(0, count($arr) - 1);
	$reference = $arr[$refIndex];

	foreach ($arr as $key => $value) {
		if ($key === $refIndex) {
			continue;
		}
		if ($value < $reference) {
			$lessThan[] = $value;
		} else {
			$moreThan[] = $value;
		}
	}

	return array_merge(quickSort($lessThan), array($reference), quickSort($moreThan));
}
