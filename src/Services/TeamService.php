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
use Symfony\Component\Config\Definition\Exception\Exception;

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

    public function teamEdit(Team $team, array $data): Team
    {
        if(isset($data['name']) && $data['name']!=''){
            $team->setName($data['name']);
        }
        if(isset($data['strip']) && $data['strip']!=''){
            $team->setStrip($data['strip']);
        }
        if(isset($data['league']) && $data['league']!=''){

                $league  = $this->entityManager->find(League::class, $data['league']);
            if(!$league) {
                throw new Exception('error: League not found');
            }

            $team->setLeague($league);
        }
        $this->entityManager->persist($team);
        $this->entityManager->flush();

        return $team;
    }

    public function leagueDelete(League $league)
    {
        $this->entityManager->remove($league);
        $this->entityManager->flush();
    }

}