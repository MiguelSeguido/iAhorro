<?php

namespace App\Repository;

use App\Entity\ExpertClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExpertClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExpertClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExpertClient[]    findAll()
 * @method ExpertClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpertClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExpertClient::class);
    }
}
