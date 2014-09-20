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
     * @param \DateTime
     * @return null|SeasonalRate
     */
    public function currentSeason(\DateTime $date)
    {
        foreach ($this->seasons as $season) {
            if ($season->contains($date)) {
                return $season;
            }
        }

        return null;
    }

    public function currentChargeBy($base, \DateTime $date)
    {
        $current = $this->currentSeason($date);

        return $current->getChargeBy($base);
    }
}
