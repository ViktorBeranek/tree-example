<?php declare(strict_types = 1);

namespace Tests\Unit\Model;

require __DIR__ . './../../bootstrap.php';

/**
 * @testCase
 */
class NodeValueSumCounterTest extends \PHPUnit\Framework\TestCase
{

	public function testSum(): void
	{
		$nodeSumCounter = new \Src\Model\NodeValueSumCounter(
			$this->getNodeRepository()
		);

		$this->assertSame(51, $nodeSumCounter->getSum(2));
		$this->assertSame(9, $nodeSumCounter->getSum(4));
		$this->assertSame(56, $nodeSumCounter->getSum(1));
		$this->assertSame(12, $nodeSumCounter->getSum(5));
	}

	public function testSumNodeDoesNotExist(): void
	{
		$nodeSumCounter = new \Src\Model\NodeValueSumCounter(
			$this->getNodeRepository()
		);

		$this->expectErrorMessage('Node not found');

		$nodeSumCounter->getSum(99999);
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

(new NodeValueSumCounterTest())->run();
