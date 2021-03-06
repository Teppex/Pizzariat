<?php
namespace App\Repository;
use App\Entity\Pizzeria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * @method Pizzeria|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pizzeria|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pizzeria[]    findAll()
 * @method Pizzeria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PizzeriaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pizzeria::class);
    }
    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('a')
            ->where('a.something = :value')->setParameter('value', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
