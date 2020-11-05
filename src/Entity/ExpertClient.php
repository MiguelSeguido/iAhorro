<?php

namespace App\Entity;

use App\Repository\ExpertClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpertClientRepository::class)
 * @ORM\Table(name="experts_clients")
 * @ORM\HasLifecycleCallbacks()
 */
class ExpertClient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MortgageExpert::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $expert;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpert(): ?MortgageExpert
    {
        return $this->expert;
    }

    public function setExpert(?MortgageExpert $expert): self
    {
        $this->expert = $expert;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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

    /**
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        $dateTimeNow = new \DateTime('now');
        $this->setCreatedAt($dateTimeNow);
    }
}
