<?php

namespace App\Finances;

use App\Exceptions\FinanceRepository as FinanceRepositoryException;
use App\Installments\InstallmentEntity;
use App\Installments\InstallmentRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Query;
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
            /**
             * @var $finance FinanceEntity
             */
            $em = $this->getEntityManager();
            $finance = $this->find('App\Finances\FinanceEntity', $id);
            $em->remove($finance);
            $em->flush();
        }catch(\Exception $e){
            throw new FinanceRepositoryException();
        }
    }

    public function findFinanceById(int $id)
    {
        return $this->createQueryBuilder('f')
            ->select()
            ->where('f.id = :id')->setParameter('id', $id)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }

    public function findInstallmentsByFinance(int $id)
    {
        $em = $this->getEntityManager();
        /**
         * @var $installmentRepository InstallmentRepository
         */
        $installmentRepository = $em->getRepository('App\Installments\InstallmentEntity');

        return $installmentRepository->createQueryBuilder('i')
            ->select()
            ->where('i.finance = :id')->setParameter('id', $id)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }

}