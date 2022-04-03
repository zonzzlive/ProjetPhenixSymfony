<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->setEmail(sprintf('user-%d@example.com', $i));
            $user->setPassword(sprintf($this->hasher->hashPassword($user, 'password')));
            $user->setFirstName(sprintf('Edgar %d', $i));
            $user->setLastName(sprintf(sprintf('Poe %d', $i)));
            if($i==0){
                $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
            }
            else{
                $user->setRoles(['ROLE_USER']);
            }

            $manager->persist($user);
            $this->addReference(User::class."_".$i, $user);
        }

        $manager->flush();

    }
}
