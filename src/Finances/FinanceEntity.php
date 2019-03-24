<?php

namespace App\Finances;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ClassMetadata;
use Hidrator\Hidrator;

/**
 * @ORM\Entity(repositoryClass="App\Finances\FinanceRepository")
 * @ORM\Table(name="finances")
 */
class FinanceEntity
{
    //Usar trait em todas entidades
    use Hidrator;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Installments\InstallmentEntity", mappedBy="finances", cascade={"persist", "remove"})
     */
    private $installments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalInstallments;

    /**
     * @ORM\Column(type="float")
     */
    private $downPayment;

    /**
     * @ORM\Column(type="integer")
     */
    private $paidInCash;

    /**
     * @ORM\Column(type="integer")
     */
    private $month;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    public function __construct()
    {
        $this->installments = new ArrayCollection();
    }

    public function getInstallments(): ArrayCollection
    {
        return $this->installments;
    }

    public function getTotalInstallments(): int
    {
        return $this->totalInstallments;
    }

    public function setTotalInstallments(int $totalInstallments)
    {
        $this->totalInstallments = $totalInstallments;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year)
    {
        $this->year = $year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function setMonth(int $month)
    {
        $this->month = $month;
    }

    public function getPaidInCash(): int
    {
        return $this->paidInCash;
    }

    public function setPaidInCash(int $paidInCash)
    {
        $this->paidInCash = $paidInCash;
    }

    public function getDownPayment(): float
    {
        return $this->downPayment;
    }

    public function setDownPayment(float $downPayment)
    {
        $this->downPayment = $downPayment;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type)
    {
        $this->type = $type;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value)
    {
        $this->value = $value;
    }

    public function getId(): int
    {
        return 1;
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }
}