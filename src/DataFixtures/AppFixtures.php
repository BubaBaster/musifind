<?php

namespace App\DataFixtures;

use App\Entity\Genres;
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
        ///////////////////////////////////////////
        $genre = new Genres();
        $manager->persist($genre->setGenre("Рок")->setGenreEn("Rock"));
        $manager->persist($genre->setGenre("Джаз")->setGenreEn("Jazz"));
        $manager->persist($genre->setGenre("Хип-хоп")->setGenreEn("Hip Hop"));
        $manager->persist($genre->setGenre("Рэп")->setGenreEn("Rqp"));
        $manager->persist($genre->setGenre("Поп")->setGenreEn("Pop"));
        $manager->persist($genre->setGenre("Блюз")->setGenreEn("Blues"));
        $manager->persist($genre->setGenre("Фолк")->setGenreEn("Folk"));
        $manager->persist($genre->setGenre("Классическая музыка")->setGenreEn("Classical music"));
        $manager->persist($genre->setGenre("Хэви-метал")->setGenreEn("Heavy Metal"));
        $manager->persist($genre->setGenre("Кантри")->setGenreEn("Country"));
        $manager->persist($genre->setGenre("Ритм-н-Блюз")->setGenreEn("Rhythm & Blues"));
        $manager->persist($genre->setGenre("Панк-рок")->setGenreEn("Punk Rock"));
        $manager->persist($genre->setGenre("Электронная музыка")->setGenreEn("Electronic Music"));
        $manager->persist($genre->setGenre("Соул")->setGenreEn("Soul"));
        $manager->persist($genre->setGenre("Рэгги")->setGenreEn("Reggae"));
        $manager->persist($genre->setGenre("Фанк")->setGenreEn("Funk"));
        $manager->persist($genre->setGenre("Техно")->setGenreEn("Techno"));
        $manager->persist($genre->setGenre("Диско")->setGenreEn("Disco"));
        $manager->persist($genre->setGenre("Альтернативный рок")->setGenreEn("Alternative Rock"));
        $manager->persist($genre->setGenre("Эмбиент")->setGenreEn("Ambient"));
        $manager->persist($genre->setGenre("Свинг")->setGenreEn("Swing"));
        $manager->persist($genre->setGenre("Индастриал")->setGenreEn("Industrial"));
        $manager->persist($genre->setGenre("Госпел")->setGenreEn("Gospel"));
        $manager->persist($genre->setGenre("Транс")->setGenreEn("Trance"));
        $manager->persist($genre->setGenre("Инструментал")->setGenreEn("Instrumental"));
        $manager->persist($genre->setGenre("Дабстэп")->setGenreEn("Dubstep"));
        $manager->persist($genre->setGenre("Брейкбит")->setGenreEn("Breakbeat"));
        $manager->persist($genre->setGenre("Ска")->setGenreEn("Ska"));
        $manager->persist($genre->setGenre("Поп-рок")->setGenreEn("Pop Rock"));
        $manager->persist($genre->setGenre("Инди-рок")->setGenreEn("Indie Rock"));
        $manager->persist($genre->setGenre("Оркестр")->setGenreEn("Orchestra"));
        $manager->persist($genre->setGenre("Психоделическая музыка")->setGenreEn("Psychedelic Music"));
        $manager->persist($genre->setGenre("Электро")->setGenreEn("Electro"));
        $manager->persist($genre->setGenre("Новая волна")->setGenreEn("New Wave"));
        $manager->persist($genre->setGenre("Экспериментальная музыка")->setGenreEn("Experimental music"));
        $manager->persist($genre->setGenre("Этническая музыка")->setGenreEn("World"));
        $manager->persist($genre->setGenre("Гранж")->setGenreEn("Grunge"));
        $manager->persist($genre->setGenre("Драм-н-бейс")->setGenreEn("Drum & Bass"));
        $manager->persist($genre->setGenre("Хардкор")->setGenreEn("Hardcore"));
        $manager->persist($genre->setGenre("Барокко")->setGenreEn("Baroque"));
        $manager->persist($genre->setGenre("Босса-нова")->setGenreEn("Bossa Nova"));
        $manager->persist($genre->setGenre("Блюграсс")->setGenreEn("Bluegrass"));
        $manager->persist($genre->setGenre("Шугейз")->setGenreEn("Shoegaze"));
        $manager->persist($genre->setGenre("Японский поп")->setGenreEn("J-Pop"));
        $manager->persist($genre->setGenre("Японский рок")->setGenreEn("J-Rock"));
        $manager->persist($genre->setGenre("Корейский поп")->setGenreEn("K-Pop"));
        $manager->persist($genre->setGenre("Корейский рок")->setGenreEn("K-Rock"));
        $manager->persist($genre->setGenre("Латиноамериканская музыка")->setGenreEn("Latin"));
        $manager->persist($genre->setGenre("Повер-метал")->setGenreEn("Power Metal"));
        $manager->persist($genre->setGenre("Опера")->setGenreEn("Opera"));
        $manager->persist($genre->setGenre("Блэк-метал")->setGenreEn("Black Metal"));
        $manager->persist($genre->setGenre("Постхардкор")->setGenreEn("Post-hardcore"));
        $manager->persist($genre->setGenre("Глэм-метал")->setGenreEn("Glam Metal"));
        $manager->persist($genre->setGenre("Глэм-рок")->setGenreEn("Glam Rock"));
        $manager->persist($genre->setGenre("Трэш-метал")->setGenreEn("Trash Metal"));
        $manager->persist($genre->setGenre("Дэт-метал")->setGenreEn("Death Metal"));
        $manager->persist($genre->setGenre("Прогрессив-метал")->setGenreEn("Progressive Metal"));
        $manager->persist($genre->setGenre("Готик-метал")->setGenreEn("Gothic Metal"));
        $manager->persist($genre->setGenre("Симфоник-метал")->setGenreEn("Symphonic Metal"));
        $manager->persist($genre->setGenre("Фолк-метал")->setGenreEn("Folk Metal"));
        $manager->persist($genre->setGenre("Ню-метал")->setGenreEn("Nu Metal"));
        $manager->persist($genre->setGenre("Индастриал-метал")->setGenreEn("Industrial Metal"));
        $manager->persist($genre->setGenre("Металкор")->setGenreEn("Metalcore"));
        $manager->persist($genre->setGenre("Клауд-рэп")->setGenreEn("Cloud Rap"));
        $manager->persist($genre->setGenre("Трэп")->setGenreEn("Trap"));
        $manager->persist($genre->setGenre("Дрилл")->setGenreEn("Drill"));
        $manager->persist($genre->setGenre("Ретро")->setGenreEn("Retro"));
        $manager->persist($genre->setGenre("Эстрада")->setGenreEn("Estrade"));
        $manager->persist($genre->setGenre("Рок-н-ролл")->setGenreEn("Rock'n'roll"));
        $manager->persist($genre->setGenre("Рэпкор")->setGenreEn("Rapcore"));
        $manager->persist($genre->setGenre("Грув-метал")->setGenreEn("Groove Metal"));
        $manager->persist($genre->setGenre("Хаус")->setGenreEn("House"));
        $manager->persist($genre->setGenre("Метал")->setGenreEn("Metal"));
        $manager->persist($genre->setGenre("Оперетта")->setGenreEn("Operetta"));
        $manager->persist($genre->setGenre("Романc")->setGenreEn("Romance"));
        $manager->persist($genre->setGenre("Шансон")->setGenreEn("Chanson"));
        $manager->persist($genre->setGenre("Гиперпоп")->setGenreEn("Hyperpop"));
        $manager->flush();

    }
}
