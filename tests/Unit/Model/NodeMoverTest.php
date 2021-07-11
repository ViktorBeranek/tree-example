<?php declare(strict_types = 1);

namespace Tests\Unit\Model;

require __DIR__ . './../../bootstrap.php';

/**
 * @testCase
 */
class NodeMoverTest extends \PHPUnit\Framework\TestCase
{

	public function testMove(): void
	{
		$nodeRepository = $this->getNodeRepository();
		$nodeMover = new \Src\Model\NodeMover($nodeRepository);

		$nodeMover->moveNode(4, 1);

		$node = $nodeRepository->findById(4);

		$this->assertSame(1, $node->getParentId());
	}

	public function testNodeNotFoundException(): void
	{
		$nodeMover = new \Src\Model\NodeMover($this->getNodeRepository());

		$this->expectExceptionMessage('Node not found');
		$nodeMover->moveNode(9999, 1);
	}


	public function testParentNodeNotFoundException(): void
	{
		$nodeMover = new \Src\Model\NodeMover($this->getNodeRepository());

		$this->expectExceptionMessage('Parent node not found');
		$nodeMover->moveNode(4, 99999);
	}


	private function getNodeRepository(): \Src\Model\NodeRepository
	{
		$nodes[] = new \Src\Model\Node(
			1,
			NULL,
			'Head node',
			5
		);

		$nodes[] = new \Src\Model\Node(
			2,
			1,
			'Pets',
			10
		);

		$nodes[] = new \Src\Model\Node(
			3,
			2,
			'Dog',
			20
		);

		$nodes[] = new \Src\Model\Node(
			4,
			2,
			'Cat',
			9
		);

		$nodes[] = new \Src\Model\Node(
			5,
			3,
			'Russel terrier',
			12
		);

		$nodeRepository = new \Src\Model\NodeRepository();

		$nodeRepository->init(...$nodes);

		return $nodeRepository;
	}


}

(new NodeMoverTest())->run();
