<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Highlight;
use App\Entity\Milestone;
use App\Entity\DateTimeInterface;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class HighlightFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++) {
            $highlight = new Highlight();
            $timestamp = mt_rand(1, time());
            $randomDate = date("Y-m-d", $timestamp);
            $randomDate = new DateTime($randomDate);

            $highlight->setProject($this->getReference(Project::class."_".random_int(0, 9)));
            $highlight->setMilestone($this->getReference(Milestone::class."_".random_int(0,1)));
            $highlight->setDate($randomDate);
            $highlight->setName(sprintf('Highlight Name %d', $i));

            $manager->persist($highlight);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProjectFixtures::class,
            MilestoneFixtures::class,
        ];
    }
}
