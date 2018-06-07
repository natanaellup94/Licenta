<?php

namespace FeedbackBundle\Repository;

use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\User;

class GoalRepository extends EntityRepository
{
    /**
     * Get active goals.
     * If sett a user filter goals by user.
     *
     * @param User|null $user
     * @return array
     */
    public function getActiveGoal(User $user = null)
    {
        $qb = $this->createQueryBuilder('g')
            ->where(':current_date BETWEEN g.startDate AND g.endDate');

        $qb->setParameter('current_date', new \DateTime());

        if(!is_null($user)){
            $qb->andWhere('g.user = :user');
            $qb->setParameter('user', $user);
        }

        $qb->orderBy('g.progress','DESC');

        return $qb->getQuery()->getResult();
    }

    /**
     * Get all user's goals.
     *
     * @param User|null $user
     * @return array
     */
    public function getGoal(User $user = null)
    {
        $qb = $this->createQueryBuilder('g');

        if(!is_null($user)){
            $qb->andWhere('g.user = :user');
            $qb->setParameter('user', $user);
        }

        $qb->orderBy('g.progress','ASC');

        return $qb->getQuery()->getResult();
    }
}