<?php

namespace App\DataFixtures;

use App\Entity\AdCategory;
use App\Entity\Ad;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class AdFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{

    public function loadData(): void
    {
        if (null === $this->manager || null === $this->faker) {
            return;
        }

        $this->createMany(100, 'ads', function (int $i) {
            $ad = new Ad();
            $ad->setTitle($this->faker->sentence);
            $ad->setCreatedAt(
                DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );
            $ad->setUpdatedAt(
                DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );

            $ad->setEmail($this->faker->email);

            $ad->setPhone($this->faker->numerify('#########'));

            $ad->setUsername($this->faker->userName);

            $ad->setText($this->faker->text(150));

            $ad->setIsVisible($this->faker->numberBetween(0, 1));

            $adCategory = $this->getRandomReference('adCategories');
            $ad->setAdCategory($adCategory);

            return $ad;
        });

        $this->manager->flush();
    }


    public function getDependencies(): array
    {
        return [AdCategoryFixtures::class];
    }
}
