<?php declare(strict_types=1);

namespace Src\Model;

class CsvInitializer implements Initializer
{

	/**
	 * @return Node[]
	 */
	public function init(string $inputFile): array
	{
		/** @var Node[] $nodes */
		$nodes = [];

		foreach (file(__DIR__. '/../../data/'.$inputFile) as $key => $item) {
			if ($key === 0) {
				continue;
			}

			$parsedItem = \str_getcsv($item);

			$nodes[] = new \Src\Model\Node(
				(int) $parsedItem[0],
				$parsedItem[1] ? (int) $parsedItem[1] : NULL ,
				$parsedItem[2],
				(int) $parsedItem[3]
			);

		}

		return  $nodes;

	}

}
