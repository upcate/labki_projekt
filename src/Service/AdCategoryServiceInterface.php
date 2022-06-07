<?php

namespace App\Service;

use App\Entity\AdCategory;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface AdCategoryServiceInterface
{
    public function getPaginatedList(int $page): PaginationInterface;

    public function save(AdCategory $adCategory): void;

    public function delete(AdCategory $adCategory): void;

    public function canBeDeleted(AdCategory $adCategory): bool;
}