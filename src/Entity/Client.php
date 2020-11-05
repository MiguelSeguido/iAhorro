<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @ORM\Table(name="clients")
 * @UniqueEntity("email")
 * @ORM\HasLifecycleCallbacks()
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastnames;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="float")
     */
    private $netIncome;

    /**
     * @ORM\Column(type="float")
     */
    private $requestedAmount;

    /**
     * @ORM\Column(type="time")
     */
    private $startAvailability;

    /**
     * @ORM\Column(type="time")
     */
    private $endAvailability;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastnames(): ?string
    {
        return $this->lastnames;
    }

    public function setLastnames(string $lastnames): self
    {
        $this->lastnames = $lastnames;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getNetIncome(): ?float
    {
        return $this->netIncome;
    }

    public function setNetIncome(float $netIncome): self
    {
        $this->netIncome = $netIncome;

        return $this;
    }

    public function getRequestedAmount(): ?float
    {
        return $this->requestedAmount;
    }

    public function setRequestedAmount(float $requestedAmount): self
    {
        $this->requestedAmount = $requestedAmount;

        return $this;
    }

    public function getStartAvailability(): ?\DateTimeInterface
    {
        return $this->startAvailability;
    }

    public function setStartAvailability(\DateTimeInterface $startAvailability): self
    {
        $this->startAvailability = $startAvailability;

        return $this;
    }

    public function getEndAvailability(): ?\DateTimeInterface
    {
        return $this->endAvailability;
    }

    public function setEndAvailability(\DateTimeInterface $endAvailability): self
    {
        $this->endAvailability = $endAvailability;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $dateTimeNow = new \DateTime('now');
        $this->setUpdatedAt($dateTimeNow);
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }
}
