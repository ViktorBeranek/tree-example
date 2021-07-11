<?php declare(strict_types = 1);

namespace Tests\Unit\Model;

require __DIR__ . './../../bootstrap.php';

/**
 * @testCase
 */
class NodeRepositoryTest extends \PHPUnit\Framework\TestCase
{

	public function testFindBy(): void
	{
		$node = $this->getNodeRepository()->findById(1);

		$this->assertSame(1, $node->getId());
		$this->assertNull($node->getParentId());
		$this->assertSame('Head node', $node->getIdentifier());
		$this->assertSame(5, $node->getValue());

		$node = $this->getNodeRepository()->findById(9999);

		$this->assertNull($node);
	}

	public function testGetAll(): void
	{
		$nodes = $this->getNodeRepository()->getAll();

		$node = $nodes[0];

		$this->assertSame(1, $node->getId());
		$this->assertNull($node->getParentId());
		$this->assertSame('Head node', $node->getIdentifier());
		$this->assertSame(5, $node->getValue());

		$this->assertCount(5, $nodes);

	}

	public function testFindByParentId(): void
	{
		$nodes = $this->getNodeRepository()->findByParent(2);

		$this->assertCount(2, $nodes);

		$this->assertSame(3, $nodes[0]->getId());
		$this->assertSame(2 ,$nodes[0]->getParentId());
		$this->assertSame('Dog', $nodes[0]->getIdentifier());
		$this->assertSame(20, $nodes[0]->getValue());

		$this->assertSame(4, $nodes[1]->getId());
		$this->assertSame(2 ,$nodes[1]->getParentId());
		$this->assertSame('Cat', $nodes[1]->getIdentifier());
		$this->assertSame(9, $nodes[1]->getValue());
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

(new NodeRepositoryTest())->run();
