<?php
namespace Sample\ExpressionLanguage\Usecase;

use Sample\ExpressionLanguage\Service\ChargeCalculator;

/**
 * 料金表示
 *
 * @package Sample\ExpressionLanguage\Usecase
 */
class ShowChargeUsecase
{
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function run($data)
    {
        $calc = new ChargeCalculator($this->config);
        $userDate = new \DateTime($data->getUsageDate());
        $result = $calc->calculateBy($data->getQuantity(), $userDate);

        return $result;
    }
}
