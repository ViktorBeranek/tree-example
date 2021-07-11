<?php declare(strict_types=1);


namespace Src\Command;

class TreePrinter
{

	private \Src\Model\NodeRepository $nodeRepository;


	public function __construct(
		\Src\Model\NodeRepository $nodeRepository
	)
	{
		$this->nodeRepository = $nodeRepository;
	}


	public function print(
		\Symfony\Component\Console\Output\OutputInterface $output
	): void
	{

		$nodes = $this->nodeRepository->getAll();
		$mainNode = $nodes[0];
		$level = 1;

		$this->writeNode(
			$output,
			$level,
			$mainNode->getIdentifier()
		);

		$this->printChilds(
			$output,
			$mainNode->getId(),
			$level,
		);
	}


	private function printChilds(
		\Symfony\Component\Console\Output\OutputInterface $output,
		int $nodeId,
		int $level
	)
	{
		$level++;

		$nodes = $this->nodeRepository->findByParent($nodeId);

		foreach ($nodes as $node) {
			$this->writeNode(
				$output,
				$level,
				$node->getIdentifier()
			);

			if ($node->getParentId()) {
				$this->printChilds(
					$output,
					$node->getId(),
					$level
				);
			}
		}
	}


	private function writeNode(
		\Symfony\Component\Console\Output\OutputInterface $output,
		int $level,
		string $identifier
	)
	{
		$output->writeln(
			\sprintf(
				'%s%s',
				\str_repeat('-', $level),
				$identifier
			)
		);
	}
}
