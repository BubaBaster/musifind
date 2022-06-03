<?php

namespace App\DataFixtures;

use App\Entity\Profile;
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
        $profile = new Profile();
        $profile->setAge(21)
            ->setCity("Санкт-Петербург")
            ->setSex("Мужской")
            ->setAbout("<h1>Всем привет</h1>");
        $user->setProfile($profile);

        $manager->persist($user);
        $manager->flush();
    }
}
