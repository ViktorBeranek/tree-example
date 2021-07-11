<?php declare(strict_types = 1);

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator();

$configurator->enableTracy(__DIR__ . '/../log');

$configurator->setDebugMode(TRUE);

$configurator->setTimeZone('Europe/Prague');
$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->addConfig(__DIR__ . '/Config/config.neon');

$container = $configurator->createContainer();

return $container;
