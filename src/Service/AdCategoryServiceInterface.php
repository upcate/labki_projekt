<?php

/**
 * AdCategoryServiceInterface,.
 */

namespace App\Service;

use App\Entity\AdCategory;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface AdCategoryServiceInterface.
 */
interface AdCategoryServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int $page
     *
     * @return PaginationInterface
     */
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Save.
     *
     * @param AdCategory $adCategory
     *
     * @return void
     */
    public function save(AdCategory $adCategory): void;

    /**
     * Delete.
     *
     * @param AdCategory $adCategory
     *
     * @return void
     */
    public function delete(AdCategory $adCategory): void;

    /**
     * Check can be deleted.
     *
     * @param AdCategory $adCategory
     *
     * @return bool
     */
    public function canBeDeleted(AdCategory $adCategory): bool;
}
