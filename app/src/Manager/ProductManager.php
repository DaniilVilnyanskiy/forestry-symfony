<?php
namespace App\Manager;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Sort;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @return Product[]
     */
    public function getProducts(Request $request): array
    {
        $filterCategory =  $request->query->has('category');
        $filterSort = $request->query->has('sort');
        $filterSize = $request->query->has('size');

        $productRepository = $this->entityManager->getRepository(Product::class);

        if ($filterCategory || $filterSort || $filterSize){
            return $this->getFilteredProducts($request);
        } else {
            return $productRepository->findAll();
        }
    }

    public function getFilteredProducts(Request $request): array
    {
        $filteredProducts = array();
        $productRepository = $this->entityManager->getRepository(Product::class);

        $filterCategory = explode('-', $request->query->get('category'));
        $filterSort = explode('-', $request->query->get('sort'));
        $filterSize = explode('-', $request->query->get('size'));

        if ($filterCategory) {
            foreach ($filterCategory as &$requestValue) {
                $product = $this->findProductsByProperty(Category::class, $requestValue);
                if ($product) $filteredProducts[] = $product;
            }
        }


        if ($filterSort) {
            foreach ($filterSort as &$requestValue) {
                $product = $this->findProductsByProperty(Sort::class, $requestValue);
                if ($product) $filteredProducts[] = $product;
            }
        }

        if ($filterSize) {
            foreach ($filterSize as &$requestValue) {
                $product = $this->findProductsByProperty(Size::class, urldecode($requestValue));
                if ($product) $filteredProducts[] = $product;
            }
        }

        return $filteredProducts;
    }

    public function findProductsByProperty($entity, string $value)
    {
        $entityProperty = $this->entityManager->getRepository($entity)->findOneBy(['value' => $value]);
        if (!$entityProperty) {
            return [];
        }
        // TODO: Почему так?
        return $entityProperty->getProducts()->toArray();
    }
}
