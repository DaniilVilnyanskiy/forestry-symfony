<?php

namespace App\DataFixtures;

use App\Entity\Sort;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class SortFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $initValue = [
            0 => [
                'title' => 'дуб',
                'value' => 'oak',
            ],
            1 => [
                'title' => 'сосна',
                'value' => 'pine',
            ],
            2 => [
                'title' => 'ель',
                'value' => 'fir',
            ]
        ];

        foreach ($initValue as $item) {
            $sort = new Sort();
            $sort->setCreatedAt();
            $sort->setUpdatedAt();
            $sort->setTitle($item['title']);
            $sort->setValue($item['value']);
            $manager->persist($sort);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['createInitEntity'];
    }
}
