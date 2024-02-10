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
            ]
        ];

        foreach ($initValue as $item) {
            $product = new Sort();
            $product->setCreatedAt();
            $product->setUpdatedAt();
            $product->setTitle($item['title']);
            $product->setValue($item['value']);
            $manager->persist($product);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
