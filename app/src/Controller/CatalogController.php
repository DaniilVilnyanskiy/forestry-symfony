<?php

namespace App\Controller;


use App\Entity\Product;
use App\Manager\ProductManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function MongoDB\BSON\toJSON;

class CatalogController extends AbstractController
{
    public function __construct(
        private readonly ProductManager $productManager
    ) {
    }

    #[Route('/catalog', name: 'app_catalog', methods: ['GET'])]
    public function index(Request $request): Response
    {
        // Здесь вы можете обработать параметры фильтрации из запроса
        $filterParam = $request->query->get('filter_param');

        // Загрузка товаров из базы данных, используя параметры фильтрации
        $products = $this->productManager->getProducts();

        return $this->render('catalog/index.html.twig', [
            'products' => array_map(static fn(Product $product) => $product->toArray(), $products),
            'controller_name' => 'CatalogController',
        ]);
    }
}
