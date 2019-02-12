<?php

namespace App\Installments;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping;
use Symfony\Bridge\Doctrine\RegistryInterface;

class InstallmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InstallmentEntity::class);
    }

    public function save(InstallmentEntity $installment)
    {
        try{
            $em = $this->getEntityManager();
            $em->persist($installment);
            $em->flush();
            // cirar exception para esse erro
        }catch(\Exception $e){
            die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r($e, true) . "</pre>");
        }

        return $installment;
    }
}