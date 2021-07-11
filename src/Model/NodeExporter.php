<?php declare(strict_types=1);

namespace Src\Model;

class NodeExporter
{

	public function export(
		string $exportFile,
		Node ...$nodes
	): void
	{
		$file = fopen(__DIR__. './../../export/'.$exportFile, 'w');

		fputcsv($file, ['id', 'parent_id', 'identifier', 'value']);

		foreach ($nodes as $node) {
			fputcsv($file, $node->toArray());
		}

		fclose($file);
	}
}
