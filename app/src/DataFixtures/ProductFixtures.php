<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setCreatedAt();
            $product->setUpdatedAt();
            $product->setTitle('product title ' . $i);
            $product->setDescription('Description of product');
            $manager->persist($product);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['createInitEntity'];
    }
}
