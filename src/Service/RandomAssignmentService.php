<?php

namespace App\Service;

use App\Service\MortgageExpertManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Client;
use App\Entity\ExpertClient;

class RandomAssignmentService
{
    private $em;
    private $mortgageExpertManager;

    public function __construct(EntityManagerInterface $em, MortgageExpertManager $mortgageExpertManager)
    {
        $this->em                    = $em;
        $this->mortgageExpertManager = $mortgageExpertManager;
    }

    public function randomAssignment(Client $client)
    {
        try {
            $num_experts = $this->mortgageExpertManager->countAll();
            $expert_id   = random_int (1 , $num_experts);
            $expert      = $this->mortgageExpertManager->getOneBy(['id' => $expert_id]);

            $expertClient = new ExpertClient();
            $expertClient->setExpert($expert);
            $expertClient->setClient($client);

            $this->em->persist($expertClient);
            $this->em->flush();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
