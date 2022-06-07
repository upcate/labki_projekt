<?php

namespace App\Service;


use App\Entity\AdCategory;
use App\Repository\AdCategoryRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\AdRepository;

class AdCategoryService implements AdCategoryServiceInterface
{
    private AdCategoryRepository $adCategoryRepository;
    private PaginatorInterface $paginator;
    private AdRepository $adRepository;

    public function __construct(AdCategoryRepository $adCategoryRepository, PaginatorInterface $paginator, AdRepository $adRepository)
    {
        $this->paginator = $paginator;
        $this->adCategoryRepository = $adCategoryRepository;
        $this->adRepository = $adRepository;
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

    public function canBeDeleted(AdCategory $adCategory): bool
    {
        try {
            $result = $this->adRepository->countByCategory($adCategory);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }

}