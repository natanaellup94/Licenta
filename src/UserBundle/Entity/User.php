<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FeedbackBundle\Entity\Goal;
use Sonata\UserBundle\Entity\BaseUser;

/**
 * The User model.
 */
class User extends BaseUser
{
    /**
     * The unique identifier of the User model.
     *
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $goals;

    protected $groups;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->goals = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * @param ArrayCollection $goals
     * @return User
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;

        return $this;
    }

    /**
     * @param Goal $goal
     * @return $this
     */
    public function addGoal(Goal $goal)
    {
        $this->goals->add($goal);

        return $this;
    }

    /**
     * @param Goal $goal
     * @return $this
     */
    public function removeGoal(Goal $goal)
    {
        $this->goals->remove($goal);

        return $this;
    }
}
