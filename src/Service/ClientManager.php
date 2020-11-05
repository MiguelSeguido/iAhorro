<?php

namespace App\Service;

use App\Entity\Client;
use App\Service\AvailabilityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ClientManager
{
    private $em;
    private $availabilityService;

    public function __construct(EntityManagerInterface $em, AvailabilityService $availabilityService)
    {
        $this->em                  = $em;
        $this->availabilityService = $availabilityService;
    }

    public function create(Request $request): ?Client
    {
        try {
            $client = new Client();
            $this->dataClient($request, $client);
            $this->availabilityService->availability($request, $client);
            $this->save($client);

            return $client; 
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function dataClient(Request $request, Client $client): ?Client 
    {
        try {
            $client->setName($request->get('name'));
            $client->setLastnames($request->get('lastnames'));
            $client->setEmail($request->get('email'));
            $client->setPhoneNumber($request->get('phone_number'));
            $client->setNetIncome($request->get('net_income'));
            $client->setRequestedAmount($request->get('requested_amount'));

            return $client;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function save(Client $client): ?Client
    {
        try {
            $this->em->persist($client);
            $this->em->flush();

            return $client;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
