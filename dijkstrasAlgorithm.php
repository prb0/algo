<?php

// $graph = [
// 	'startpoint' => [
// 		'a' => 2,
// 		'b' => 5,
// 	],
// 	'a' => [
// 		'b' => 8,
// 		'd' => 7,
// 	],
// 	'b' => [
// 		'd' => 2,
// 		'c' => 4,
// 	],
// 	'c' => [
// 		'd' => 6,
// 		'endpoint' => 3,
// 	],
// 	'd' => [
// 		'endpoint' => 1,
// 	],
// 	'endpoint' => [],
// ];
$graph = [
	'startpoint' => [
		'a' => 10,
	],
	'a' => [
		'c' => 20,
	],
	'b' => [
		'a' => 1,
	],
	'c' => [
		'b' => 1,
		'endpoint' => 30,
	],
	'endpoint' => [],
];
$costs = [
	'a' => 10,
	'b' => INF,
	'c' => INF,
	'endpoint' => INF,
];
$parents = [
	'a' => 'startpoint',
	'b' => null,
	'c' => null,
	'endpoint' => null,
];

$algo = new DijkstrasAlgorithm($graph, $costs, $parents);

echo $algo->getCheapestWay();

class DijkstrasAlgorithm
{
	private $graph;
	private $costs;
	private $parents;
	private $processed = [];

	public function __construct($graph, $costs, $parents)
	{
		$this->graph = $graph;
		$this->costs = $costs;
		$this->parents = $parents;
	}

	public function getCheapestWay()
	{
		$node = $this->findLowestCostNode();

		while ($node !== null) {
			$cost = $this->costs[$node];
			$neighbours = $this->graph[$node];

			foreach ($this->getNeighbours($neighbours) as $n) {
				$newCost = $cost + $neighbours[$n];

				if ($this->costs[$n] > $newCost) {
					$this->costs[$n] = $newCost;
					$this->parents[$n] = $node;
				}
			}

			$this->processed[$node] = null;
			$node = $this->findLowestCostNode($this->costs);
		}

		return $this->costs['endpoint'];
	}

	private function findLowestCostNode()
	{
		$lowestCost = INF;
		$lowestCostNode = null;

		foreach ($this->costs as $node => $cost) {
			if ($cost < $lowestCost && !array_key_exists($node, $this->processed)) {
				$lowestCost = $cost;
				$lowestCostNode = $node;
			}
		}

		return $lowestCostNode;
	}

	private function getNeighbours($node)
	{
		return array_keys($node);
	}
}
