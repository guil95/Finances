<?php

namespace App\Finances;

use App\Facades\HidratorEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Finances\FinanceRepository")
 */
class FinanceEntity
{
    //Use trait in all entities for this project
    use HidratorEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @ORM\Column(type="int")
     */
    private $type;

    /**
     * @ORM\Column(type="int")
     */
    private $totalInstallments;

    /**
     * @ORM\Column(type="int")
     */
    private $downPayment;

    public function getTotalInstallments(): int
    {
        return $this->totalInstallments;
    }

    public function setTotalInstallments(int $totalInstallments)
    {
        $this->totalInstallments = $totalInstallments;
    }

    public function getDownPayment(): int
    {
        return $this->downPayment;
    }

    public function setDownPayment(int $downPayment)
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