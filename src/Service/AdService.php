<?php

/**
 * AdService.
 */

namespace App\Service;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class AdService.
 */
class AdService implements AdServiceInterface
{
    /**
     * AdRepository.
     *
     * @var AdRepository Ad repository
     */
    private AdRepository $adRepository;

    /**
     * PaginatorInterface.
     *
     * @var PaginatorInterface Paginator interface
     */
    private PaginatorInterface $paginator;

    /**
     * AdCategoryServiceInterface.
     *
     * @var AdCategoryServiceInterface Ad category service interface
     */
    private AdCategoryServiceInterface $adCategoryService;

    /**
     * Constructor.
     *
     * @param AdRepository               $adRepository      Ad repository
     * @param PaginatorInterface         $paginator         Paginator interface
     * @param AdCategoryServiceInterface $adCategoryService Ad category service interface
     */
    public function __construct(AdRepository $adRepository, PaginatorInterface $paginator, AdCategoryServiceInterface $adCategoryService)
    {
        $this->adRepository = $adRepository;
        $this->paginator = $paginator;
        $this->adCategoryService = $adCategoryService;
    }

    /**
     * Get paginated list.
     *
     * @param int   $page
     * @param array $filters
     *
     * @return PaginationInterface
     */
    public function getPaginatedList(int $page, array $filters = []): PaginationInterface
    {
        $filters = $this->prepareFilters($filters);

        return $this->paginator->paginate(
            $this->adRepository->queryAll($filters),
            $page,
            AdRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Get paginated list with ads to accept.
     *
     * @param int $page
     *
     * @return PaginationInterface
     */
    public function getPaginatedAcceptList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->adRepository->queryToAccept(),
            $page,
            AdRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save.
     *
     * @param Ad $ad
     *
     * @return void
     */
    public function save(Ad $ad): void
    {
        $this->adRepository->save($ad);
    }

    /**
     * Save on creation by admin.
     *
     * @param Ad $ad
     *
     * @return void
     */
    public function saveOnCreateAdm(Ad $ad): void
    {
        $ad->setIsVisible(1);
        $this->adRepository->save($ad);
    }

    /**
     * Save on creation by user.
     *
     * @param Ad $ad
     *
     * @return void
     */
    public function saveOnCreateUs(Ad $ad): void
    {
        $ad->setIsVisible(0);
        $this->adRepository->save($ad);
    }

    /**
     * Delete.
     *
     * @param Ad $ad
     *
     * @return void
     */
    public function delete(Ad $ad): void
    {
        $this->adRepository->delete($ad);
    }

    /**
     * Make ad visible.
     *
     * @param Ad $ad
     *
     * @return void
     */
    public function makeVisible(Ad $ad): void
    {
        $ad->setIsVisible(1);
        $this->adRepository->save($ad);
    }

    /**
     * Prepare filters.
     *
     * @param array $filters
     *
     * @return array
     */
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
