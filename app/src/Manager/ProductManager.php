<?php
namespace App\Manager;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
class ProductManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        $productRepository = $this->entityManager->getRepository(Product::class);

        return $productRepository->findAll();
    }
}
