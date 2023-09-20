<?php

$path = '';
$costs = [];
$parents = [];
$processed = [];
$nodes = [
	'A',
	'B',
	'C',
	'D',
];
$graph = [
	'A' => [
		'B' => 15,
		'C' => 10,
		'D' => 20,
	],
	'B' => [
		'A' => 15,
		'C' => 20,
		'D' => 11,
	],
	'C' => [
		'A' => 10,
		'B' => 20,
		'D' => 13,
	],
	'D' => [
		'A' => 20,
		'B' => 11,
		'C' => 13,
	],
];
$startNodeKey = $nodes[rand(0, count($nodes) - 1)];
$currentNode = $graph[$startNodeKey];
$processed[$startNodeKey] = null;
$path .= $startNodeKey;

while ($currentNode) {
	$lowestCostNode = null;
	$lowestCost = INF;

	foreach ($currentNode as $node => $cost) {
		if ($cost < $lowestCost && !array_key_exists($node, $processed)) {
			$lowestCostNode = $node;
			$lowestCost = $cost;
		}
	}

	$currentNode = $lowestCostNode ? $graph[$lowestCostNode] : $lowestCostNode;
	$processed[$lowestCostNode] = null;
	$path .= ', ' . $lowestCostNode;
}

echo $path;
