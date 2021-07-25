<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client;
use Faker;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tmp_password = 'motdepasse';
        $faker = Faker\Factory::create();
        
        for($i = 0; $i < 5; $i++){
            $client = new Client();
            $client_reference = 'client-'.$i;

            $client->setEmail($faker->safeEmail());
            $client->setPassword(password_hash($tmp_password, PASSWORD_BCRYPT));

            $this->addReference($client_reference, $client);

            $manager->persist($client);
        }

        $manager->flush();
    }
}
