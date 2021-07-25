<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\ClientFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\User;
use Faker;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        
        for($i = 0; $i < 15; $i++){
            $user = new User();

            $user->setEmail($faker->safeEmail());
            $user->setUsername($faker->userName());
            $user->setClient($this->getReference('client-'.rand(0,4)));

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ClientFixtures::class,
        );
    }
}
