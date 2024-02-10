<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $initValue = [
            0 => [
                'title' => '20*20*1000',
                'value' => '20*20*1000',
            ],
            1 => [
                'title' => '20*30*1000',
                'value' => '20*30*1000',
            ],
            2 => [
                'title' => '20*40*1000',
                'value' => '20*40*1000',
            ]
        ];

        foreach ($initValue as $item) {
            $size = new Size();
            $size->setCreatedAt();
            $size->setUpdatedAt();
            $size->setTitle($item['title']);
            $size->setValue($item['value']);
            $manager->persist($size);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['createInitEntity'];
    }
}
