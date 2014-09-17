<?php
namespace Sample\ExpressionLanguage\Entity;

use PHPMentors\DomainKata\Entity\EntityInterface;

/**
 * サービス使用量
 *
 * @package Sample\ExpressionLanguage\Entity
 */
class UserUsage implements EntityInterface
{
    private $usageDate;
    private $quantity;

    public function __construct($usageDate, $quantity)
    {
        $this->usageDate = $usageDate;
        $this->quantity = $quantity;
    }

    /**
     * @param mixed $usage_date
     */
    public function setUsageDate($usage_date)
    {
        $this->usageDate = $usage_date;
    }

    /**
     * @return mixed
     */
    public function getUsageDate()
    {
        return $this->usageDate;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
