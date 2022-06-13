<?php

namespace App\Service;



use App\Entity\Ad;
use App\Repository\AdRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class AdService implements AdServiceInterface
{
    private AdRepository $adRepository;
    private PaginatorInterface $paginator;
    private AdCategoryServiceInterface $adCategoryService;

    public function __construct(AdRepository $adRepository, PaginatorInterface $paginator, AdCategoryServiceInterface $adCategoryService)
    {
        $this->adRepository = $adRepository;
        $this->paginator = $paginator;
        $this->adCategoryService = $adCategoryService;
    }

    public function getPaginatedList(int $page, array $filters = []): PaginationInterface
    {
        $filters = $this->prepareFilters($filters);
        return $this->paginator->paginate(
            $this->adRepository->queryAll($filters),
            $page,
            AdRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    public function getPaginatedAcceptList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->adRepository->queryToAccept(),
            $page,
            AdRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    public function save(Ad $ad): void
    {
        $this->adRepository->save($ad);
    }

    public function saveOnCreateAdm(Ad $ad): void
    {
        $ad->setIsVisible(1);
        $this->adRepository->save($ad);
    }

    public function saveOnCreateUs(Ad $ad): void
    {
        $ad->setIsVisible(0);
        $this->adRepository->save($ad);
    }

    public function delete(Ad $ad): void
    {
        $this->adRepository->delete($ad);
    }

    public function makeVisible(Ad $ad): void
    {
        $ad->setIsVisible(1);
        $this->adRepository->save($ad);
    }

    private function prepareFilters(array $filters): array
    {
        $resultFilters = [];
        if (!empty($filters['adCategory_id'])) {
            $adCategory = $this->adCategoryService->findOneById($filters['adCategory_id']);
            if (null !== $adCategory) {
                $resultFilters['adCategory'] = $adCategory;
            }
        }

        return $resultFilters;
    }

}