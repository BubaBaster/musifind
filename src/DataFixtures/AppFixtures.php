<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new Users();
        $user->setFullName("Guts")
            ->setLogin("guts")
            ->setPassword(password_hash("Qwerty54321",PASSWORD_DEFAULT));

        $manager->persist($user);
        $manager->flush();
    }
}
