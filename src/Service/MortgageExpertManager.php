<?php

namespace App\Service;

use App\Entity\MortgageExpert;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MortgageExpertRepository;
use Symfony\Component\HttpFoundation\Request;

class MortgageExpertManager
{
    private $em;
    private $mortgageExpertRepository;

    public function __construct(EntityManagerInterface $em, MortgageExpertRepository $mortgageExpertRepository)
    {
        $this->em                        = $em;
        $this->mortgageExpertRepository  = $mortgageExpertRepository;
    }


    public function getOneBy(array $conditions): ?MortgageExpert
    {
        try {
            return $this->mortgageExpertRepository->findOneBy($conditions);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function countAll(): ?int
    {
        try {
            return $this->em->createQuery('SELECT COUNT(me.id) FROM App:MortgageExpert me')->getSingleScalarResult();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
