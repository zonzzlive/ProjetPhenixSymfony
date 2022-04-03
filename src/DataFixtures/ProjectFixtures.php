<?php

namespace App\DataFixtures;

use App\Entity\Portfolio;
use App\Entity\Status;
use App\Entity\Team;
use App\Entity\Project;
use App\Entity\DateTimeInterface;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++) {
            $project = new Project();
            $timestamp = mt_rand(1, time());
            $randomDate = date("Y-m-d", $timestamp);
            $randomDate = new DateTime($randomDate);

            $project->setName(sprintf('Project Name %d', $i));
            $project->setDescription(sprintf('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lacinia cursus tortor id volutpat. Nunc sed nisl purus. Sed nisl diam, finibus ac convallis eu, placerat quis augue. Nulla maximus maximus dapibus. Aliquam nec orci egestas, ultricies lectus a, hendrerit massa. Morbi imperdiet nibh vel lacinia finibus. Nunc dignissim ac nunc sed lobortis. Ut suscipit tincidunt quam a pharetra. Donec mollis ut dolor ut fringilla. Aenean sollicitudin consectetur libero a malesuada.', $i));
            $project->setCode(sprintf('Code Name %d', $i));
            $project->setArchive(sprintf('FALSE', $i));
            $project->setStatus($this->getReference(Status::class."_".random_int(0, 2)));
            $project->setPortfolio($this->getReference(Portfolio::class."_".random_int(0, 9)));
            $project->setTeamProject($this->getReference(Team::class."_".random_int(0, 1)));
            $project->setClientTeam($this->getReference(Team::class."_".random_int(0, 1)));
            $project->setStartBudget(sprintf(random_int(1, 10000)));
            $project->setConsBudget(sprintf(random_int(1, 10000)));
            $project->setToDoBudget(sprintf(random_int(1, 10000)));
            $project->setArchive(sprintf(random_int(0, 1)));
            $project->setCreatedAt($randomDate);
            $project->setEndedAt($randomDate);
            
            $manager->persist($project);
            $this->addReference(Project::class."_".$i, $project);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StatusFixtures::class,
            PortfolioFixtures::class,
            TeamFixtures::class,
        ];
    }
}
