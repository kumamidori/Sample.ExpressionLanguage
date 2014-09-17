<?php
namespace Sample\ExpressionLanguage\Service;

use Symfony\Component\ExpressionLanguage\Expression;

/**
 * 料金計算クラス
 *
 * @package Sample\ExpressionLanguage\Service
 */
class ChargeCalculator
{
    private $config;
    private $rateService;
    private static $ratePerUnit;

    /**
     * @param array $config 料金設定
     */
    public function __construct(array $config = array())
    {
        $this->config = $config;

        $rateService = new SeasonalRateService();
        foreach ($config as $season => $current) {
            $rateService->add(
                new SeasonalRate(
                    $season,
                    [
                        'span' => new Expression($current['span']),
                        'formula' => new Expression($current['formula'])
                    ]
                )
            );
        }
        $this->rateService = $rateService;
        $app = require __DIR__ . '/../../app/config/app.php';
        static::$ratePerUnit = $app['charge_rate_per_unit'];
    }

    /**
     * 料金を量と日付から計算して取得する
     *
     * @param int $quantity
     * @param \DateTimeImmutable $time
     * @return int
     */
    public function calculateBy($quantity, \DateTimeImmutable $time)
    {
        return $this->rateService->currentChargeBy($quantity * static::$ratePerUnit, $time);
    }
}
