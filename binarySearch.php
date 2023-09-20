<?php

$list = [];

for ($i = 0; $i < 1000; $i++) { 
	$list[$i] = $i*3;
}

$key = recoursiveBinarySearch($list[555], $list);

echo $key;
echo "<br>";


function search($item, $sortedArr) {
	if (empty($sortedArr)) {
		return null;
	}

	$opCount = 0;

	foreach ($sortedArr as $key => $value) {
		$opCount++;

		if ($item == $value) {
			echo 'simple operations:' . $opCount;
			echo "<br>";
			return $key;
		}
	}

	return null;
}

function binarySearch($item, $sortedArr) {
	if (empty($sortedArr)) {
		return null;
	}

	$min = 0;
	$max = count($sortedArr) - 1;

	while ($min <= $max) {
		$opCount++;

		$middle = (int) ($min + $max) / 2;	
		$guess = $sortedArr[$middle];

		if ($guess == $item) {
			return $middle;
		}
		if ($guess > $item) {
			$max = $middle - 1;
		} else {
			$min = $middle + 1;
		}
	}

	return null;
}

function recoursiveBinarySearch($item, $sortedArr, $max = 0, $min = 0) {
	if (empty($sortedArr) || count($sortedArr) == 1 && $item !== $sortedArr[0]) {
		return null;
	}
	if (!$max) {
		$max = count($sortedArr) - 1;
	}

	$middle = (int) ($min + $max) / 2;	
	$guess = $sortedArr[$middle];

	if ($guess == $item) {
		return $middle;
	}
	if ($guess > $item) {
		$max = $middle - 1;
	} else {
		$min = $middle + 1;
	}

	return recoursiveBinarySearch($item, $sortedArr, $max, $min);
}
