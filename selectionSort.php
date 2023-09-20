<?php

$arr = [10, 5, 15, 16, 4, 6, 111, 3, 20];
$arr = selectionSort($arr);

echo "<pre>";
print_r($arr);

function selectionSort($arr) {
	$result = [];
	$arrLen = count($arr);

	for ($i = 0; $i < $arrLen; $i++) { 
		$smallest = findSmallest($arr);

		array_push($result, $arr[$smallest]);
		unset($arr[$smallest]);

		$arr = array_values($arr);
	}

	return $result;
}

function findSmallest($arr) {
	$smallest = $arr[0];
	$smallestIndex = 0;

	foreach ($arr as $key => $value) {
		if ($arr[$key] < $smallest) {
			$smallest = $arr[$key];
			$smallestIndex = $key;
		}
	}

	return $smallestIndex;
}
