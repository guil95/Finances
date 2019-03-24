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
            $em->flush();
        }catch(\Exception $e){
            throw new FinanceRepositoryException();
        }

        return $finance;
    }

    public function delete($id)
    {
        try{
            $finance = $this->find($id);
            $em = $this->getEntityManager();
            $em->remove($finance);
            $em->flush();
        }catch(\Exception $e){
            throw new FinanceRepositoryException();
        }
    }

}