<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\Profile;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
        $faker = \Faker\Factory::create('fr_FR');
         $profile = new Profile();
         $profile->setName($faker->name())
                ->setLastName($faker->lastname())
                ->setDescription($faker->paragraph());
        $manager->persist($profile);
        }
        $manager->flush();

        $regularUser = new User();
        $regularUser
            ->setEmail('User@use.com')
            ->setPassword( 'test');

        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
          ->setEmail('admin@ad.com')
          ->setRoles(['ROLE_ADMIN'])
          ->setPassword('test');

        $manager->persist($adminUser);
        
        $apiToken = new ApiToken();
        $apiToken
          ->setNameToken("louis")
          ->setToken("jJcXeSWnU2WdzT7sQugHSwGiIsKWe4O3");
  
        $manager->persist($apiToken);

        $manager->flush();
    }
}
