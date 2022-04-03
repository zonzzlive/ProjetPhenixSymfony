<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 3; $i++) {
            $status = new Status();

            $status->setNameStatus(sprintf('Status %d', $i));
            $status->setSlug(sprintf('%d', $i));
            $status->setValue(sprintf('%d', $i));

            $manager->persist($status);
            $this->addReference(Status::class."_".$i, $status);
        }

        $manager->flush();

    }
}
