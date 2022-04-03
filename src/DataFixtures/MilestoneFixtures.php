<?php

namespace App\DataFixtures;

use App\Entity\Milestone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MilestoneFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 2; $i++) {
            $milestone = new Milestone();

            $milestone->setName(sprintf('milestone %d', $i));
            $milestone->setValue(sprintf(random_int(1, 3)));

            $manager->persist($milestone);
            $this->addReference(Milestone::class."_".$i, $milestone);
        }

        $manager->flush();
    }
}
