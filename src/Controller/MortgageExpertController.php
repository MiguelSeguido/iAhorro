<?php

namespace App\Controller;

use Swagger\Annotations as SWG;
use App\Service\MortgageExpertManager;
use JMS\Serializer\SerializerInterface;
use App\Service\ClientsAvailableService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;

/**
 * Class MortgageExpertController
 *
 * @Route("/api/v1")
 */
class MortgageExpertController extends AbstractFOSRestController
{
    private $mortgageExpertManager;
    private $availableService;
    private $serializerInterface;

    public function __construct(MortgageExpertManager $mortgageExpertManager, ClientsAvailableService $availableService, SerializerInterface $serializerInterface)
    {
        $this->mortgageExpertManager = $mortgageExpertManager; 
        $this->availableService      = $availableService;   
        $this->serializerInterface   = $serializerInterface;
    }

    /**
     * @Rest\Get("/mortgageexpert/clients/available/{id}", name="clients_available", defaults={"_format":"json"})
     */

    public function create(Request $request, int $id): JsonResponse
    {
        try {
            $data   = null;
            $expert = $this->mortgageExpertManager->getOneBy(['id' => $id]);
            if($expert)
                $data = $this->availableService->availability($expert);

            $response = ['code' => 200, 'error' => false, 'data' => $this->serializerInterface->serialize($data, 'json')];
        } catch (\Throwable $th) {
            $response = ['code' => 500, 'error' => true, 'data' => $th->getMessage()];
        }

        return new JsonResponse($response);
    }
}
