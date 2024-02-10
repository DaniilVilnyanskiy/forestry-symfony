<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $initValue = [
            0 => [
                'title' => 'вагонка',
                'value' => 'clapboard',
            ],
            1 => [
                'title' => 'доска прямая',
                'value' => 'board_straight',
            ],
            2 => [
                'title' => 'брус',
                'value' => 'balk',
            ]
        ];

        foreach ($initValue as $item) {
            $category = new Category();
            $category->setCreatedAt();
            $category->setUpdatedAt();
            $category->setTitle($item['title']);
            $category->setValue($item['value']);
            $manager->persist($category);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['createInitEntity'];
    }
}
