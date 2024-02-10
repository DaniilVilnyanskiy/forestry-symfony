<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Sort;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $sizes = $this->createSizes($manager);
        $sorts = $this->createSorts($manager);
        $categories = $this->createCategory($manager);

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setCreatedAt();
            $product->setUpdatedAt();
            $product->setTitle('product title ' . $i);
            $product->setDescription('Description of product');

            $randomSizeIndex = rand(0, count($sizes) - 1);
            $randomSortIndex = rand(0, count($sorts) - 1);
            $randomCategoryIndex = rand(0, count($categories) - 1);
            $product->addSize($sizes[$randomSizeIndex]);
            $product->addSort($sorts[$randomSortIndex]);
            $product->addCategory($categories[$randomCategoryIndex]);

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function createSizes(ObjectManager $manager): array
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
        $sizeArray = [];

        foreach ($initValue as $item) {
            $size = new Size();
            $size->setCreatedAt();
            $size->setUpdatedAt();
            $size->setTitle($item['title']);
            $size->setValue($item['value']);
            $sizeArray[] = $size;
            $manager->persist($size);
        }

//        $manager->flush();
        return $sizeArray;
    }

    public function createSorts(ObjectManager $manager): array
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
        $sortArray = [];

        foreach ($initValue as $item) {
            $sort = new Sort();
            $sort->setCreatedAt();
            $sort->setUpdatedAt();
            $sort->setTitle($item['title']);
            $sort->setValue($item['value']);
            $sortArray[] = $sort;
            $manager->persist($sort);
        }

//        $manager->flush();
        return $sortArray;
    }

    function createCategory(ObjectManager $manager): array
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
        $categoryArray = [];

        foreach ($initValue as $item) {
            $category = new Category();
            $category->setCreatedAt();
            $category->setUpdatedAt();
            $category->setTitle($item['title']);
            $category->setValue($item['value']);
            $categoryArray[] = $category;
            $manager->persist($category);
        }

//        $manager->flush();
        return $categoryArray;
    }
}
