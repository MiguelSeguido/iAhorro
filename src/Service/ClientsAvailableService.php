<?php

namespace App\Service;

use App\Entity\MortgageExpert;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\Request;

class ClientsAvailableService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;    
    }
    
    public function availability(MortgageExpert $expert): ?array
    {
        try {
            $rsm     = new ResultSetMapping();
            $clients = $this->em->createNativeQuery('SELECT clients.* FROM clients INNER JOIN experts_clients ON clients.id = experts_clients.client_id 
                        WHERE experts_clients.client_id = '. $expert->getId() .' AND CONVERT(clients.start_availability, TIME) <= CONVERT(CURRENT_TIMESTAMP, TIME) 
                        AND CONVERT(clients.end_availability, TIME) > CONVERT(CURRENT_TIMESTAMP, TIME) 
                        ORDER BY HOUR(TIMEDIFF(CONVERT(CURRENT_TIMESTAMP, TIME),CONVERT(clients.created_at, TIME))), 
                        HOUR(TIMEDIFF(CONVERT(CURRENT_TIMESTAMP, TIME),CONVERT(clients.created_at, TIME))) * (clients.net_income/clients.requested_amount)', $rsm)->getResult();

            return $clients;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
