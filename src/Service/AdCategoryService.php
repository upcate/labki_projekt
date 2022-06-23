<?php
/**
 *
 * AdCategoryService.
 *
 */
namespace App\Service;


use App\Entity\AdCategory;
use App\Repository\AdCategoryRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\AdRepository;

/**
 *
 * Class AdCategoryService.
 *
 */
class AdCategoryService implements AdCategoryServiceInterface
{
    /**
     * AdCategoryRepository.
     *
     * @var AdCategoryRepository
     *
     */
    private AdCategoryRepository $adCategoryRepository;

    /**
     * PaginatorInterface.
     *
     * @var PaginatorInterface
     *
     */
    private PaginatorInterface $paginator;

    /**
     * AdRepository.
     *
     * @var AdRepository
     *
     */
    private AdRepository $adRepository;

    /**
     * Constructor.
     *
     * @param AdCategoryRepository $adCategoryRepository Ad category repository
     * @param PaginatorInterface $paginator Paginator interface
     * @param AdRepository $adRepository Ad repository
     *
     */
    public function __construct(AdCategoryRepository $adCategoryRepository, PaginatorInterface $paginator, AdRepository $adRepository)
    {
        $this->paginator = $paginator;
        $this->adCategoryRepository = $adCategoryRepository;
        $this->adRepository = $adRepository;
    }

    /**
     * Get paginated list.
     *
     * @param int $page
     * @return PaginationInterface
     *
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->adCategoryRepository->queryAll(),
            $page,
            AdCategoryRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save.
     *
     * @param AdCategory $adCategory
     * @return void
     *
     */
    public function save(AdCategory $adCategory): void
    {
        if(null == $adCategory->getId()) {
            $adCategory->setCreatedAt(new \DateTimeImmutable());
        }
        $adCategory->setUpdatedAt(new \DateTimeImmutable());

        $this->adCategoryRepository->save($adCategory);
    }

    /**
     * Delete.
     *
     * @param AdCategory $adCategory
     * @return void
     *
     */
    public function delete(AdCategory $adCategory): void
    {
        $this->adCategoryRepository->delete($adCategory);
    }

    /**
     * Check can be deleted.
     *
     * @param AdCategory $adCategory
     * @return bool
     *
     */
    public function canBeDeleted(AdCategory $adCategory): bool
    {
        try {
            $result = $this->adRepository->countByCategory($adCategory);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }

    /**
     * Find one by id.
     *
     * @param int $id
     * @return AdCategory|null
     *
     */
    public function findOneById(int $id): ?AdCategory
    {
        return $this->adCategoryRepository->findOneById($id);
    }

}