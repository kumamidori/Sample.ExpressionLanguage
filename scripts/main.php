<?php

require __DIR__ . '/../vendor/autoload.php';

use Sample\ExpressionLanguage\Usecase\ShowChargeUsecase;
use Sample\ExpressionLanguage\Entity\UserUsage;

$usecase = new ShowChargeUsecase();

//fixture
$userDate = '2014-09-17';
$quantity = 2;
$input = new UserUsage($userDate, $quantity);

var_dump($usecase->run($input));
