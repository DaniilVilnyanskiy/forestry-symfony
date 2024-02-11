<?php

namespace App\Controller;


use App\Entity\Product;
use App\Manager\FilterManager;
use App\Manager\ProductManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    public function __construct(
        private readonly ProductManager $productManager,
        private readonly FilterManager $filterManager
    ) {
    }

    #[Route('/catalog', name: 'app_catalog', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $filters = $this->filterManager->getFilters();
        $testArray = [];

        // Загрузка товаров из базы данных, также используя параметры фильтрации
        $products = $this->productManager->getProducts($request);

        // TODO: исправить на оптимизированный вариант
        if ($products[0] instanceof Product) {
            $products = array_map(static fn(Product $product) => $product->toArray(), $products);
        } else {
            foreach ($products as &$item) {
                if (count($item)) {
                    foreach ($item as &$el) {
                        $testArray[] = $el->toArray();
                    }
                } else {
                    $testArray[] = $item->toArray();
                }

            }
        }
        if (count($testArray)) {
            $products = $testArray;
        }

        return $this->render('catalog/index.html.twig', [
            'filters' => $filters,
            'products' => $products,
            'controller_name' => 'CatalogController',
        ]);
    }
}
