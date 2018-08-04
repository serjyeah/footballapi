<?php
/**
 * Created by PhpStorm.
 * User: serj
 * Date: 8/4/18
 * Time: 2:26 PM
 */

namespace App\Services;


use App\Entity\League;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;

class TeamService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @param League $league
     * @return Team
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function teamCreate(array $data, League $league): Team
    {
        $team = new Team();
        $team->setName($data['name']);
        $team->setStrip($data['strip']);
        $team->setLeague($league);

        $this->entityManager->persist($team);
        $this->entityManager->flush();

        return $team;
    }

}