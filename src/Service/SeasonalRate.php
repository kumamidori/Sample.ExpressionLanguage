<?php
namespace Sample\ExpressionLanguage\Service;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * 料金の季節変動レートクラス
 *
 * @package Sample\ExpressionLanguage\Service
 */
class SeasonalRate
{
    private $seasonName;
    private $expressions;
    private $expressionLanguage;

    public function __construct($seasonName, array $expressions)
    {
        $this->seasonName = $seasonName;
        $this->expressions = $expressions;
        $this->expressionLanguage = new ExpressionLanguage();
    }

    public function contains(\DateTimeInterface $date)
    {
        return $this->expressionLanguage->evaluate(
            $this->expressions['span'],
            ['date' => $date->format('md')]
        );
    }

    /**
     * 基本料金をもとに設定式により料金を得る
     *
     * @param $base
     * @return string
     */
    public function getChargeBy($base)
    {
        return $this->expressionLanguage->evaluate(
            $this->expressions['formula'],
            ['base' => $base]
        );
    }

    public function getSeasonName()
    {
        return $this->seasonName;
    }
}
