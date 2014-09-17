<?php

namespace Sample\ExpressionLanguage\Usecase;

use Sample\ExpressionLanguage\Entity\UserUsage;

class ShowChargeUsecaseTest extends \PHPUnit_Framework_TestCase
{
    public function testShowChargeUsecaseReturnsBaseCaseDefault()
    {
        $userDate = '2014-09-17';
        $quantity = 2;
        $input = new UserUsage($userDate, $quantity);

        $usecase = new ShowChargeUsecase();

        $expected = 8000 * 2;
        $this->assertSame($expected, $usecase->run($input));
    }

    public function testShowChargeUsecaseReturnsExtraChargeCaseSummer()
    {
        $userDate = '2014-07-15';
        $quantity = 4;
        $input = new UserUsage($userDate, $quantity);

        $usecase = new ShowChargeUsecase();

        $expected = 8000 * 4 * 1.2 + 1000;
        $this->assertSame($expected, $usecase->run($input));
    }
}
