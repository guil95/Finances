<?php

namespace App\Finances;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ClassMetadata;
use Hidrator\Hidrator;

/**
 * @ORM\Entity(repositoryClass="App\Finances\FinanceRepository")
 * @ORM\Table(name="finances")
 */
class FinanceEntity
{
    //Use trait in all entities for this project
    use Hidrator;

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
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalInstallments;

    /**
     * @ORM\Column(type="integer")
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