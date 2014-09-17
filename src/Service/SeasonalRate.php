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

    public function contains(\DateTimeInterface $time)
    {
        return $this->expressionLanguage->evaluate(
            $this->expressions['span'],
            ['time' => $time->format('md')]
        );
    }

    public function chargeBy($base)
    {
        return $this->expressionLanguage->evaluate(
            $this->expressions['formula'],
            ['base' => $base]
        );
    }

    /**
     * @return mixed
     */
    public function getSeasonName()
    {
        return $this->seasonName;
    }
}
