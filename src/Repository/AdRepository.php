<?php

/**
 * AdRepository.
 */

namespace App\Repository;

use App\Entity\Ad;
use App\Entity\AdCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class AdRepository.
 *
 * @extends ServiceEntityRepository<Ad>
 *
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    /**
     * Items per page.
     */
    public const PAGINATOR_ITEMS_PER_PAGE = 10;

    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry Manager Registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    /**
     * Query All.
     *
     * @param array $filters
     *
     * @return QueryBuilder
     */
    public function queryAll(array $filters): QueryBuilder
    {
        $queryBuilder = $this->getOrCreateQueryBuilder()
            ->select('partial ad.{id, createdAt, updatedAt, title, text, isVisible, phone, username}', 'partial adCategory.{id, name}')
            ->where('ad.isVisible = 1')
            ->join('ad.adCategory', 'adCategory')
            ->orderBy('ad.updatedAt', 'DESC');

        return $this->applyFiltersToList($queryBuilder, $filters);
    }

    /**
     * Query ads to accept.
     *
     * @return QueryBuilder
     */
    public function queryToAccept(): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()
            ->select('partial ad.{id, createdAt, updatedAt, title, text, isVisible, phone, username}', 'partial adCategory.{id, name}')
            ->where('ad.isVisible = 0')
            ->join('ad.adCategory', 'adCategory')
            ->orderBy('ad.createdAt', 'DESC');
    }

    /**
     * Add.
     *
     * @param Ad $entity
     * @param bool $flush
     *
     * @return void
     */
    public function add(Ad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Remove.
     *
     * @param Ad $entity
     * @param bool $flush
     *
     * @return void
     */
    public function remove(Ad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Count by category.
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countByCategory(AdCategory $adCategory): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('ad.id'))
            ->where('ad.adCategory = :adCategory')
            ->setParameter(':adCategory', $adCategory)
            ->getQuery()
            ->getSingleScalarResult();
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
        $this->_em->persist($ad);
        $this->_em->flush();
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
        $this->_em->remove($ad);
        $this->_em->flush();
    }

    /**
     * Apply filters to the list.
     *
     * @param QueryBuilder $queryBuilder
     * @param array $filters
     *
     * @return QueryBuilder
     */
    private function applyFiltersToList(QueryBuilder $queryBuilder, array $filters = []): QueryBuilder
    {
        if (isset($filters['adCategory']) && $filters['adCategory'] instanceof AdCategory) {
            $queryBuilder->andWhere('adCategory = :adCategory')
                ->setParameter('adCategory', $filters['adCategory']);
        }

        return $queryBuilder;
    }

    /**
     * Get ot create query builder.
     *
     * @param QueryBuilder|null $queryBuilder
     *
     * @return QueryBuilder
     */
    private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return $queryBuilder ?? $this->createQueryBuilder('ad');
    }

//    /**
//     * @return Ad[] Returns an array of Ad objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ad
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
