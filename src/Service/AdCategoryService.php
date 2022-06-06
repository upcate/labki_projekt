<?php

namespace App\Service;


use App\Entity\AdCategory;
use App\Repository\AdCategoryRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class AdCategoryService implements AdCategoryServiceInterface
{
    private AdCategoryRepository $adCategoryRepository;
    private PaginatorInterface $paginator;

    public function __construct(AdCategoryRepository $adCategoryRepository, PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
        $this->adCategoryRepository = $adCategoryRepository;
    }

    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->adCategoryRepository->queryAll(),
            $page,
            AdCategoryRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    public function save(AdCategory $adCategory): void
    {
        if(null == $adCategory->getId()) {
            $adCategory->setCreatedAt(new \DateTimeImmutable());
        }
        $adCategory->setUpdatedAt(new \DateTimeImmutable());

        $this->adCategoryRepository->save($adCategory);
    }

    public function delete(AdCategory $adCategory): void
    {
        $this->adCategoryRepository->delete($adCategory);
    }

}