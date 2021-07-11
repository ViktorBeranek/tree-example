<?php declare(strict_types=1);

namespace Src\Model;

class NodeValueSumCounter
{

	private NodeRepository $nodeRepository;


	public function __construct(
		NodeRepository $nodeRepository
	)
	{
		$this->nodeRepository = $nodeRepository;
	}


	/**
	 * @throws \Exception
	 */
	public function getSum(
		int $nodeId
	): int {
		$sum = 0;

		$selectedNode = $this->nodeRepository->findById($nodeId);

		if ( ! $selectedNode) {
			throw new \Exception('Node not found');
		}

		$sum += $selectedNode->getValue();

		$sum += $this->getChildSum(
			$selectedNode->getId(),
			0,
		);

		return $sum;
	}


	private function getChildSum(
		int $nodeId,
		int $childSum,
	) : int {

		$nodes = $this->nodeRepository->findByParent($nodeId);

		foreach ($nodes as $node) {
			$childSum += $node->getValue();

			$childSum = $this->getChildSum(
				$node->getId(),
				$childSum,
			);
		}

		return $childSum;
	}
}
