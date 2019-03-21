<?php
/**
 * Created by PhpStorm.
 * User: grodrigues
 * Date: 12/02/19
 * Time: 15:47
 */

namespace App\Installments;

use Doctrine\ORM\Mapping as ORM;
use Hidrator\Hidrator;

/**
 * @ORM\Entity(repositoryClass="App/Installments/InstallmentsRepository")
 */
class InstallmentEntity
{
    use Hidrator;

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

    /**
     * @ORM\Column(type="number")
     */
    private $value;

    /**
     * @ORM\Column(type="integer")
     */
    private $installmentNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $month;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    //prennchida caso for tipo debito (pago ou em aberto)
    /**
     * @ORM\Column(type="integer")
     */
    private $paidOut;

    public function getIdFinance(): int
    {
        return $this->id_finance;
    }

    public function setIdFinance(int $id_finance)
    {
        $this->id_finance = $id_finance;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(float $value)
    {
        $this->value = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function setMonth(int $month)
    {
        $this->month = $month;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year)
    {
        $this->year = $year;
    }

    public function getPaidOut(): int
    {
        return $this->paidOut;
    }

    public function setPaidOut(int $paidOut)
    {
        $this->paidOut = $paidOut;
    }

    public function getInstallmentNumber(): int
    {
        return $this->installmentNumber;
    }

    public function setInstallmentNumber(int $installmentNumber)
    {
        $this->installmentNumber = $installmentNumber;
    }
}