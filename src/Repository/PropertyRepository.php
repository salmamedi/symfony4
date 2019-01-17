<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\Search;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use MongoDB\Driver\Query;
//use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use DateTime;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
// * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }


     public function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = false');
    }

    /**
     * @return Query
     */
    public function findAllVisbileQuery($search): Query
    {
        $query =  $this->findVisibleQuery();

        //die(var_dump($search->getMaxPrice().'and'.$search->getMinRoom()));

        if($search->getMaxPrice())
        {
            $query = $query
                ->andWhere('p.price < :price')
                ->setParameter('price', $search->getMaxPrice())
            ;
        }
        if ($search->getMinRoom())
        {
            $query = $query
                ->andWhere('p.rooms >= :room')
                ->setParameter('room', $search->getMinRoom())
            ;
        }

        if($search->getOptions()->count() > 0)
        {
            $key = 0;
            foreach ($search->getOptions() as $option) {
                $key++;
                $query = $query
                    ->andWhere(":option$key MEMBER OF p.options")
                    ->setParameter("option$key", $option)
                    ;
            }
        }

        return $query->getQuery();

    }

   public function findLAtest() : array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = false')
             ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findActive()
    {   //new DateTime('-30 days')
        return $this->createQueryBuilder('p')
            ->andWhere('p.expiresAt >= :date')
            ->setParameter('date', new DateTime())
            ->getQuery()
            ->getResult()
            ;
    }



    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
