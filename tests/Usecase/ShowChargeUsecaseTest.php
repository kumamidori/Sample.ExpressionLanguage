<?php

namespace Sample\ExpressionLanguage\Usecase;

use Sample\ExpressionLanguage\Config\ApplicationConfig;
use Sample\ExpressionLanguage\Data\UserUsage;

class ShowChargeUsecaseTest extends \PHPUnit_Framework_TestCase
{
    public function testShowChargeUsecaseReturnsBaseCaseDefault()
    {
        $userDate = '2014-09-01';
        $quantity = 2;
        $fixture = new UserUsage($userDate, $quantity);

        $app = new ApplicationConfig();
        $usecase = new ShowChargeUsecase($app->getConfig());

        $expected = 8000 * 2 * 1.2  + 1000;
        $this->assertSame($expected, $usecase->run($fixture));
    }

    public function testShowChargeUsecaseReturnsExtraChargeCaseSummer()
    {
        $userDate = '2014-07-01';
        $quantity = 4;
        $fixture = new UserUsage($userDate, $quantity);

        $app = new ApplicationConfig();
        $usecase = new ShowChargeUsecase($app->getConfig());

        $expected = 8000 * 4 * 0.9;
        $this->assertSame($expected, $usecase->run($fixture));
    }
}
