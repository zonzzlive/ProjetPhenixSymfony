<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Team;
use App\Entity\TeamMembre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TeamMemberFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++) {
            $teamMembre = new TeamMembre();

            $teamMembre->setUser($this->getReference(User::class."_".random_int(0, 9)));
            $teamMembre->setTeam($this->getReference(Team::class."_".random_int(0, 1)));

            $manager->persist($teamMembre);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TeamFixtures::class,
        ];
    }
}
