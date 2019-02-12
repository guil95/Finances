<?php
/**
 * Created by PhpStorm.
 * User: grodrigues
 * Date: 12/02/19
 * Time: 15:47
 */

namespace App\Installments;

use App\Facades\HidratorEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App/Installments/InstallmentsRepository")
 */
class InstallmentEntity
{
    use HidratorEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_finance;

    public function getIdFinance(): int
    {
        return $this->id_finance;
    }

    public function setIdFinance(int $id_finance)
    {
        $this->id_finance = $id_finance;
    }


    public function getId()
    {
        return $this->id;
    }

}