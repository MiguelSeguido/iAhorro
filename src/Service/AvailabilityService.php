<?php

namespace App\Service;

use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;

class AvailabilityService
{
    
    public function availability(Request $request, Client $client): Client
    {
        try {
            $start    = new \DateTime($request->get('start_availability'));
            $end      = new \DateTime($request->get('end_availability'));
            $interval = date_diff($start, $end);
            $diff     = $interval->format('%h');

            if($diff < 1 || $diff > 8){
                throw new Exception("Availability error", 1);
            }else{
                $client->setStartAvailability($start);
                $client->setEndAvailability($end);
            }
            
            return $client;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
