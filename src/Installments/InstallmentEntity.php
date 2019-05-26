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
 * @ORM\Entity(repositoryClass="App\Installments\InstallmentRepository")
 * @ORM\Table(name="installments")
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
     * @ORM\ManyToOne(targetEntity="App\Finances\FinanceEntity", inversedBy="installments")
     * @ORM\JoinColumn(name="finance_id", referencedColumnName="id", nullable=FALSE)
     */
    private $finance;

    /**
     * @ORM\Column(type="float")
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

    public function getFinance()
    {
        return $this->finance;
    }

    public function setFinance($finance)
    {
        $this->finance = $finance;
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