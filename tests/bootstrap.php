<?php

declare(strict_types=1);

if (!$loader = @include './vendor/autoload.php') {
    die('Project dependencies missing');
}

$loader->add('IP2ProxyYii\Test', __DIR__);