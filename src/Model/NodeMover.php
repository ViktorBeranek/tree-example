<?php declare(strict_types=1);

namespace Src\Model;

class NodeMover
{

	private NodeRepository $nodeRepository;


	public function __construct(
		NodeRepository $nodeRepository
	)
	{
		$this->nodeRepository = $nodeRepository;
	}


	public function moveNode(
		int $id,
		?int $newParent
	): void
	{
		$selectedNode = $this->nodeRepository->findById($id);

		if ( ! $selectedNode) {
			throw new \Exception('Node not found');
		}

		if ( ! $newParent) {
			$selectedNode->setParentId(NULL);

			return;
		}

		$parent = $this->nodeRepository->findById($newParent);

		if ( ! $parent) {
			throw new \Exception('Parent node not found');
		}

		$selectedNode->setParentId($newParent);
	}
}
