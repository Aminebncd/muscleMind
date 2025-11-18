<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (is_array($env = @include dirname(__DIR__).'/.env.local.php')) {
    $_SERVER += $env;
    $_ENV += $env;
} elseif (!class_exists(Dotenv::class)) {
    throw new LogicException('Symfony Dotenv is not installed. Try running "composer require symfony/dotenv".');
} else {
    (new Dotenv())->usePutenv(false)->bootEnv(dirname(__DIR__).'/.env');
}
