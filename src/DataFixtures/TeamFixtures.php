<?php

namespace App\DataFixtures;

use App\Entity\League;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    const LEAGUES = ['league_premier', 'league_one', 'league_two'];
    const STRIPS = ['red', 'green', 'blue', 'orange', 'black and white', 'white'];

    public function __construct()
    {

    }

    public function load(ObjectManager $manager)
    {


        $this->makeTeam('AC London', $manager);
        $this->makeTeam('A.F.C. Aldermaston', $manager);
        $this->makeTeam('A.F.C. Blackpool', $manager);
        $this->makeTeam('Bacup Borough', $manager);
        $this->makeTeam('Badshot Lea', $manager);
        $this->makeTeam('Bagshot', $manager);
        $this->makeTeam('Cadbury Athletic', $manager);
        $this->makeTeam('Cadbury Heath', $manager);
        $this->makeTeam('Callington Town', $manager);
        $this->makeTeam('Dagenham & Redbridge', $manager);
        $this->makeTeam('Daisy Hill', $manager);
        $this->makeTeam('Darlington', $manager);
        $manager->flush();

    }

    private function makeTeam(string $name, ObjectManager $manager)
    {
        $team = new Team();
        $team->setName($name);
        $team->setStrip(self::STRIPS[rand(0, count(self::STRIPS)-1)]);
        $team->setLeague($this->getReference(self::LEAGUES[rand(0, count(self::LEAGUES)-1)]));
        $manager->persist($team);
    }
}
