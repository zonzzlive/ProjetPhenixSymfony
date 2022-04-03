<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Risk;
use App\Entity\RiskProject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RiskProjectFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++) {
            $riskProject = new RiskProject();

            $riskProject->setProject($this->getReference(Project::class."_".random_int(0, 9)));
            $riskProject->setRisk($this->getReference(Risk::class."_".random_int(0,9)));

            $manager->persist($riskProject);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProjectFixtures::class,
            RiskFixtures::class,
        ];
    }
}
