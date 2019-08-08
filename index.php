<?php

require_once 'vendor/autoload.php';

use Jenssegers\Blade\Blade;

/** @var Blade $blade */
$blade = new Blade('views', 'cache');

/** @var string $hostname */
$hostname = gethostname();

echo $blade->render('index', ['hostname' => $hostname]);