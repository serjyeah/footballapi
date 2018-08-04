<?php

namespace App\DataFixtures;

use App\Entity\League;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LeagueFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $league = new League();
        $league->setName('Premier League');

        $manager->persist($league);
        $manager->flush();
        $this->addReference('league_premier', $league);

        $league = new League();
        $league->setName('League One');
        $this->setReference('league_one', $league);
        $manager->persist($league);

        $league = new League();
        $league->setName('League Two');
        $this->setReference('league_two', $league);
        $manager->persist($league);

        $manager->flush();
    }
}
