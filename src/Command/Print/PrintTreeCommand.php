<?php declare(strict_types = 1);

namespace Src\Command\Print;


class PrintTreeCommand extends \Symfony\Component\Console\Command\Command
{

	private \Src\Model\Initializer $initializer;
	private \Src\Command\TreePrinter $treePrinter;
	private \Src\Model\NodeRepository $nodeRepository;


	public function __construct(
		\Src\Model\Initializer $initializer,
		\Src\Command\TreePrinter $treePrinter,
		\Src\Model\NodeRepository $nodeRepository
	)
	{
		parent::__construct();
		$this->initializer = $initializer;
		$this->treePrinter = $treePrinter;
		$this->nodeRepository = $nodeRepository;
	}


	public static function getDefaultName(): string
	{
		return 'tree:print';
	}


	protected function configure(): void
	{
		$this->addOption(
			'input',
			NULL,
			\Symfony\Component\Console\Input\InputOption::VALUE_REQUIRED,
			'Input file'
		);
	}


	protected function execute(
		\Symfony\Component\Console\Input\InputInterface $input,
		\Symfony\Component\Console\Output\OutputInterface $output
	): int
	{
		/** @var string $inputFile */
		$inputFile = $input->getOption('input');

		$tree = $this->initializer->init($inputFile);
		$this->nodeRepository->init(...$tree);

		$this->treePrinter->print($output);

		return 0;
	}
}
