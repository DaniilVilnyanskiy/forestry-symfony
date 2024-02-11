<?php
namespace App\Manager;

use App\Entity\Category;
use App\Entity\Size;
use App\Entity\Sort;
use Doctrine\ORM\EntityManagerInterface;
class FilterManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        $sorts = $this->getProp(Sort::class);
        $sizes = $this->getProp(Size::class);
        $categories = $this->getProp(Category::class);

        $filters = [
            'category' => [
                'title' => 'Категория',
                'value' => $categories
            ],
            'sort' => [
                'title' => 'Сорт',
                'value' => $sorts
            ],
            'size' => [
                'title' => 'Размеры',
                'value' => $sizes
            ],
        ];

        return $filters;
    }

    function getProp($class)
    {
        $props = $this->entityManager->getRepository($class)->findAll();
        return array_map(static fn($prop) => $prop->toCustomArray(), $props);
    }
}
