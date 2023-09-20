<?php

$graph = [
	'Artem' => [
		'Slava',
		'Katya',
	],
	'Dima' => [
		'Artem',
		'Katya',
	],
	'Lesha' => [
		'Katya',
		'Slava',
		'Jack',
	],
	'Katya' => [
		'Max',
		'Slava',
		'Lesha',
		'Artem',
	],
	'Slava' => [
		'Andrey',
		'Max',
		'Oleg',
	],
	'Andrey' => [
		'Ashley',
		'Artem',
		'Jack',
	],
	'Jack' => [
		'Steve',
		'Olga',
		'Kirill',
	],
	'Kirill' => [
		'Kent',
	],
	'Kent' => [
		'Kris',
	],
	'Ashley' => [
		'Katya',
	],
	'Max' => [],
	'Oleg' => [],
	'Steve' => [],
	'Olga' => [],
];
$startEntity = 'Dima';
$searcher = new BreadthFirstSearcher(
	$graph,
	new Queue([$startEntity])
);
$result = $searcher->search(
	new class implements Comparator {
		public function compare($entity, $toCompare = 'Kris') : bool {
			return $entity === $toCompare;
		}
	}
);

echo "<br>";
echo 'Answer: ' . $result;

class BreadthFirstSearcher
{
	private $queue;
	private $graph;
	private $checkedEntites = [];

	public function __construct(Array $graph, Queue $queue)
	{
		$this->graph = $graph;
		$this->queue = $queue;
	}

	public function search(Comparator $comparator)
	{
		while (!empty($this->queue)) {
			$searched = $this->queue->getFirst();

			if ($comparator->compare($searched)) {
				return $searched;
			}

			$this->addCheckedEntity($searched);

			foreach ($this->graph[$searched] as $entity) {
				if (array_key_exists($entity, $this->checkedEntites)) {
					continue;
				}

				echo "$entity";
				echo "<br>";

				if ($comparator->compare($entity)) {
					return $entity;
				} else {
					$this->addCheckedEntity($entity);
					$this->queue->append($entity);
				}
			}
		}

		return null;
	}

	private function addCheckedEntity($entity) : void
	{
		$this->checkedEntites[$entity] = null;
	}
}

class Queue
{
	private $list;

	public function __construct(Array $list = [])
	{
		$this->list = $list;
	}

	public function getFirst()
	{
		return array_shift($this->list);
	}

	public function append($entity) : void
	{
		$this->list[] = $entity;
	}
}

interface Comparator
{
	public function compare($first, $second) : bool;
}
