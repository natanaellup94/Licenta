<?php
namespace TestBundle\Entity;


use Doctrine\ORM\EntityRepository;

class TestRepository extends EntityRepository
{
    public function getLikeName($name)
    {
        $queryBuilder = $this->createQueryBuilder('t')
            ->where('t.name like :name')
            ->orderBy('t.name', 'ASC')
            ->setParameter('name', '%'.$name.'%');
        //fetch matching cities
        $cities = $queryBuilder->getQuery()->getResult();

        return $cities;
    }
}