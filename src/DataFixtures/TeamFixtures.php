<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 2; $i++) {
            $team = new Team();

            $team->setName(sprintf('team %d', $i));
            $team->setTeamLeader($this->getReference(User::class."_".random_int(0, 9)));

            $manager->persist($team);
            $this->addReference(Team::class."_".$i, $team);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
