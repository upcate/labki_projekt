<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use DateTimeImmutable;

class AdFixtures extends Fixture
{
    protected Generator $faker;
    protected ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();

        for($i = 0;$i<10;++$i) {
            $ad = new Ad();
            $ad->setTitle($this->faker->sentence);
            $ad->setCreatedAt(
                DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $ad->setUpdatedAt(
                DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $ad->setEmail($this->faker->email);
            $ad->setPhone($this->faker->numerify('#########'));
            $ad->setUsername($this->faker->userName);
            $ad->setText($this->faker->text(150));
            $ad->setIsVisible($this->faker->numberBetween(0, 1));

            $manager->persist($ad);
        }
        $manager->flush();
    }
}