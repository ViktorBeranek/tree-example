<?php declare(strict_types = 1);

namespace Src\Command\SumValue;


class SumValueCommand extends \Symfony\Component\Console\Command\Command
{

	private \Src\Model\Initializer $initializer;
	private \Src\Model\NodeValueSumCounter $nodeValueSumCounter;
	private \Src\Model\NodeRepository $nodeRepository;


	public function __construct(
		\Src\Model\Initializer $initializer,
		\Src\Model\NodeValueSumCounter $nodeValueSumCounter,
		\Src\Model\NodeRepository $nodeRepository
	)
	{
		parent::__construct();
		$this->initializer = $initializer;
		$this->nodeValueSumCounter = $nodeValueSumCounter;
		$this->nodeRepository = $nodeRepository;
	}


	public static function getDefaultName(): string
	{
		return 'tree:sum';
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

		$id = $input->getOption('id');

		$sum = $this->nodeValueSumCounter->getSum((int) $id);

		$output->writeln(
			\sprintf('Sum of node ID %s is %s', $id, $sum)
		);

		return 0;

	}
}
