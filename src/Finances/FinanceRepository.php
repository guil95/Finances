<?php

namespace App\Finances;

use App\Exceptions\FinanceRepositoryException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping;
use Symfony\Bridge\Doctrine\RegistryInterface;

class FinanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FinanceEntity::class);
    }

    public function save(FinanceEntity $finance)
    {
        die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r($finance, true) . "</pre>");
        try{
            $em = $this->getEntityManager();
            $em->persist($finance);
            $em->flush();
        }catch(\Exception $e){
            throw new FinanceRepositoryException();
        }

        return $finance;
    }
}