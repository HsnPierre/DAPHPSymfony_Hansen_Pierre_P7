<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Customer;
use Faker;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        
        for($i = 0; $i < 15; $i++){
            $customer = new Customer();

            $customer->setEmail($faker->safeEmail());
            $customer->setUsername($faker->userName());
            $customer->setClient($this->getReference('user-'.rand(0,4)));

            $manager->persist($customer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
