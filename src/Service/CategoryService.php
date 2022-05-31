<?php

namespace App\Service;

use App\Repository\CategoryRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;


class CategoryService implements CategoryServiceInterface
{
    private CategoryRepository $categoryRepository;
    private PaginatorInterface $paginator;

    public function __construct(CategoryRepository $categoryRepository, PaginatorInterface $paginator)
    {

        $this->categoryRepository = $categoryRepository;
        $this->paginator = $paginator;

    }

    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->categoryRepository->queryAll(),
            $page,
            CategoryRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}