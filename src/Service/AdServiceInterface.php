<?php

namespace App\Service;

use App\Entity\Ad;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface AdServiceInterface
{
    public function getPaginatedList(int $page): PaginationInterface;

    public function save(Ad $ad): void;
    public function saveOnCreateAdm(Ad $ad): void;
    public function saveOnCreateUs(Ad $ad): void;

    public function makeVisible(Ad $ad): void;

    public function delete(Ad $ad): void;
}