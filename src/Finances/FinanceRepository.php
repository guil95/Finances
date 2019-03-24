<?php

namespace App\Finances;

use App\Exceptions\FinanceRepositoryException;
use App\Installments\InstallmentEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping;
use Symfony\Bridge\Doctrine\RegistryInterface;

class FinanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FinanceEntity::class);
    }

    public function add(FinanceEntity $finance, ArrayCollection $installment)
    {
        try{
            $em = $this->getEntityManager();
            $em->persist($finance);
//            $em->($installment);
            $em->flush();
        }catch(\Exception $e){
            die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r($e->getMessage(), true) . "</pre>");
            throw new FinanceRepositoryException();
        }

        return $finance;
    }
}