<?php declare(strict_types = 1);

namespace Src\Command\Move;


class MoveCommand extends \Symfony\Component\Console\Command\Command
{

	private \Src\Model\Initializer $initializer;
	private \Src\Command\TreePrinter $treePrinter;
	private \Src\Model\NodeMover $nodeMover;
	private \Src\Model\NodeExporter $nodeExporter;
	private \Src\Model\NodeRepository $nodeRepository;


	public function __construct(
		\Src\Model\Initializer $initializer,
		\Src\Command\TreePrinter $treePrinter,
		\Src\Model\NodeMover $nodeMover,
		\Src\Model\NodeExporter $nodeExporter,
		\Src\Model\NodeRepository $nodeRepository
	)
	{
		parent::__construct();
		$this->initializer = $initializer;
		$this->treePrinter = $treePrinter;
		$this->nodeMover = $nodeMover;
		$this->nodeExporter = $nodeExporter;
		$this->nodeRepository = $nodeRepository;
	}


	public static function getDefaultName(): string
	{
		return 'tree:move';
	}


	protected function configure(): void
	{
		$this->addOption(
			'input',
			NULL,
			\Symfony\Component\Console\Input\InputOption::VALUE_REQUIRED,
			'Input file'
		);

		$this->addOption(
			'id',
			NULL,
			\Symfony\Component\Console\Input\InputOption::VALUE_REQUIRED,
			'Node id'
		);

		$this->addOption(
			'newParent',
			NULL,
			\Symfony\Component\Console\Input\InputOption::VALUE_REQUIRED,
			'New node parent'
		);

		$this->addOption(
			'output',
			NULL,
			\Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL,
			'export file'
		);
	}


	protected function execute(
		\Symfony\Component\Console\Input\InputInterface $input,
		\Symfony\Component\Console\Output\OutputInterface $output
	): int
	{
		/** @var string $inputFile */
		$inputFile = $input->getOption('input');

		/** @var string|null $outputFile */
		$outputFile = $input->getOption('output');

		$tree = $this->initializer->init($inputFile);
		$this->nodeRepository->init(...$tree);

		$id = $input->getOption('id');
		$newParent = $input->getOption('newParent') ?? NULL;

		$this->nodeMover->moveNode(
			(int) $id,
			(int) $newParent,
		);

		if ($outputFile) {
			/** @var string|null $inputFile */
			$this->nodeExporter->export($outputFile, ...$tree);

			$output->writeln(\sprintf('Tree exported to /export/%s', $inputFile));

			return 0;
		}

		$this->treePrinter->print($output);

		return 0;
	}
}
