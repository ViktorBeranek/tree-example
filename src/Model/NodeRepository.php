<?php declare(strict_types=1);

namespace Src\Model;

class NodeRepository
{

	/**
	 * @var Node[]
	 */
	private array $nodes;

	public function init(Node ...$nodes)
	{
		$this->nodes = $nodes;
	}


	public function findById(int $id): ?Node
	{
		foreach ($this->nodes as $node) {
			if ($node->getId() === $id) {
				return  $node;
			}
		}

		return NULL;
	}


	public function findByParent(int $parentId)
	{
		$nodes = [];

		foreach ($this->nodes as $node) {
			if ($node->getParentId() === $parentId) {
				$nodes[] = $node;
			}
		}

		return $nodes;
	}


	public function getAll()
	{
		return $this->nodes;
	}
}
