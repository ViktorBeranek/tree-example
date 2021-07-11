<?php declare(strict_types=1);

namespace Src\Model;

class Node
{

	private int $id;

	private ?int $parentId;

	private string $identifier;

	private int $value;


	public function __construct(
		int $id,
		?int $parentId,
		string $identifier,
		int $value
	)
	{
		$this->id = $id;
		$this->parentId = $parentId;
		$this->identifier = $identifier;
		$this->value = $value;
	}


	public function getId(): int
	{
		return $this->id;
	}


	public function getParentId(): ?int
	{
		return $this->parentId;
	}


	public function getIdentifier(): string
	{
		return $this->identifier;
	}


	public function getValue(): int
	{
		return $this->value;
	}


	public function setParentId(?int $parentId): void
	{
		$this->parentId = $parentId;
	}

	public function toArray(): array
	{
		return [
			$this->getId(),
			$this->getParentId(),
			$this->getIdentifier(),
			$this->getValue()
		];
	}
}
