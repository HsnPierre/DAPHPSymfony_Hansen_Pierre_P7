<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tmp_password = 'motdepasse';
        $faker = Faker\Factory::create();
        
        for($i = 0; $i < 5; $i++){
            $user = new User();
            $user_reference = 'user-'.$i;

            $user->setEmail($faker->safeEmail());
            $user->setPassword(password_hash($tmp_password, PASSWORD_BCRYPT));

            $this->addReference($user_reference, $user);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
