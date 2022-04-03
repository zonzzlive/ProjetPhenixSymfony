<?php

namespace App\DataFixtures;

use App\Entity\Portfolio;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PortfolioFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++) {
            $portfolio = new Portfolio();

            $portfolio->setName(sprintf('portfolio %d', $i));
            $portfolio->setUser($this->getReference(User::class."_".$i));

            $manager->persist($portfolio);
            $this->addReference(Portfolio::class."_".$i, $portfolio);
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
