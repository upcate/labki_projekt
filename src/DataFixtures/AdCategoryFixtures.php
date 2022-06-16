<?php

namespace App\DataFixtures;

use App\Entity\AdCategory;
use DateTimeImmutable;

class AdCategoryFixtures extends AbstractBaseFixtures
{
    /*
     *
     * generate random data using Faker
     *
     */

    public function loadData(): void
    {
        $this->createMany(20, 'adCategories', function(int $i) {
                $adCategory = new AdCategory();
                $adCategory->setName($this->faker->unique()->word);
                $adCategory->setCreatedAt(
                    DateTimeImmutable::createFromMutable(
                        $this->faker->dateTimeBetween('-100 days', '-1 days')
                    )
                );
                $adCategory->setUpdatedAt(
                    DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                    )
                );
                return $adCategory;
            });

        $this->manager->flush();
    }

}