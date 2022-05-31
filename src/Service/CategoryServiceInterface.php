<?php

namespace App\Service;

use Knp\Component\Pager\Pagination\PaginationInterface;

interface CategoryServiceInterface
{
    public function getPaginatedList(int $page): PaginationInterface;
}