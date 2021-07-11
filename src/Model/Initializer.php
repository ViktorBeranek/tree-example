<?php declare(strict_types=1);

namespace Src\Model;

interface Initializer
{

	/**
	 * @return Node[]
	 */
	public function init(string $inputFile): array;
}
