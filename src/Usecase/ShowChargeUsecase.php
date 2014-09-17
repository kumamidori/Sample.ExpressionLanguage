<?php
namespace Sample\ExpressionLanguage\Usecase;

use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Usecase\QueryUsecaseInterface;
use Sample\ExpressionLanguage\Service\ChargeCalculator;

class ShowChargeUsecase extends AbstractUsecase implements QueryUsecaseInterface
{
    /**
     * @param  \PHPMentors\DomainKata\Entity\EntityInterface $entity
     * @return mixed
     */
    public function run(EntityInterface $entity)
    {
        $calc = new ChargeCalculator($this->config);
        $userDate = new \DateTimeImmutable($entity->getUsageDate());
        $result = $calc->calculateBy($entity->getQuantity(), $userDate);

        return $result;
    }
}
