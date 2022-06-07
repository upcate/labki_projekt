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

    public function __construct(AdRepository $adRepository, PaginatorInterface $paginator)
    {
        $this->adRepository = $adRepository;
        $this->paginator = $paginator;
    }

    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->adRepository->queryAll(),
            $page,
            AdRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    public function save(Ad $ad): void
    {
        $this->adRepository->save($ad);
    }

    public function delete(Ad $ad): void
    {
        $this->adRepository->delete($ad);
    }

}