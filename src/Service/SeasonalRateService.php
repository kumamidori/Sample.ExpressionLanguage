<?php
namespace Sample\ExpressionLanguage\Service;

/**
 * 料金の季節変動レートサービスクラス
 *
 * @package Sample\ExpressionLanguage\Service
 */
class SeasonalRateService
{
    private $seasons;

    public function __construct()
    {
        $this->seasons = [];
    }

    public function add(SeasonalRate $seasonalRate)
    {
        $this->seasons[$seasonalRate->getSeasonName()] = $seasonalRate;
    }

    /**
     * @param \DateTimeImmutable
     * @return null|SeasonalRate
     */
    public function currentSeason(\DateTimeImmutable $time)
    {
        foreach ($this->seasons as $season) {
            if ($season->contains($time)) {
                return $season;
            }
        }

        return null;
    }

    public function currentChargeBy($base, \DateTimeImmutable $time)
    {
        $current = $this->currentSeason($time);
        return $current->chargeBy($base);
    }
}
