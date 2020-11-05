<?php

namespace App\Controller;

use App\Service\RandomAssignmentService;
use App\Service\ClientManager;
use Swagger\Annotations as SWG;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;

/**
 * Class ClientController
 *
 * @Route("/api/v1")
 */
class ClientController extends AbstractFOSRestController
{
    private $clientManager;
    private $randomAssignmentService;
    private $serializer;

    public function __construct( ClientManager $clientManager, RandomAssignmentService $randomAssignmentService, SerializerInterface $serializer)
    {
        try {
            $this->clientManager           = $clientManager;
            $this->randomAssignmentService = $randomAssignmentService;
            $this->serialize               = $serializer;        
        } catch (\Throwable $th) {
            throw $th;
        }
    } 

    /**
     * @Rest\Post("/client", name="create_client", defaults={"_format":"json"})
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $client   = $this->clientManager->create($request);
            $this->randomAssignmentService->randomAssignment($client);
            
            $response = ['code' => 200, 'data' => $this->serializer->serialize($client, 'json')];
        } catch (\Throwable $th) {
            $response = ['code' => 500, 'data' => $th->getMessage()];
        }

        return new JsonResponse($response);
    }
}
