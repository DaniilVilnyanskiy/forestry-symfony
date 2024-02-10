<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
          $product = new Product();
          $product->setTitle('product title '.$i);
          $product->setDescription('Description of product');
          $manager->persist($product);
        }

        $manager->flush();
    }
}
