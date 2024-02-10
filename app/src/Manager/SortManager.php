<?php
namespace App\Manager;

use App\Entity\Sort;
use Doctrine\ORM\EntityManagerInterface;
class SortManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @return Sort[]
     */
    public function getSorts(): array
    {
        $productRepository = $this->entityManager->getRepository(Sort::class);

        return $productRepository->findAll();
    }
}
