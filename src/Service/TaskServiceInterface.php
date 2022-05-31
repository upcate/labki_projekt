<?php

namespace App\Service;

use Knp\Component\Pager\Pagination\PaginationInterface;
use App\Entity\Category;

interface TaskServiceInterface
{
    public function getPaginatedList(int $page): PaginationInterface;
}