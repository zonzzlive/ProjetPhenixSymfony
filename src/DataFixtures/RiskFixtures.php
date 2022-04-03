<?php

namespace App\DataFixtures;

use App\Entity\Risk;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RiskFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++) {
            $risk = new Risk();

            $risk->setName(sprintf('Risk %d', $i));
            $risk->setProbability(sprintf(random_int(0, 100)));
            $risk->setSeverity(sprintf(random_int(0, 10)));

            $manager->persist($risk);
            $this->addReference(Risk::class."_".$i, $risk);
        }
        $manager->flush();
    }
}
