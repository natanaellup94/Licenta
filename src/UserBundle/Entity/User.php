<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FeedbackBundle\Entity\Goal;
use FeedbackBundle\Entity\Session;
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

    /**
     * @var ArrayCollection
     */
    protected $toSessions;

    /**
     * @var ArrayCollection
     */
    protected $fromSessions;

    protected $groups;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->goals        = new ArrayCollection();
        $this->toSessions   = new ArrayCollection();
        $this->fromSessions = new ArrayCollection();
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

    /**
     * @param Session $session
     * @return $this
     */
    public function addToSession(Session $session)
    {
        $this->toSessions->add($session);

        return $this;
    }

    /**
     * @param Session $session
     * @return $this
     */
    public function removeToSession(Session $session)
    {
        $this->toSessions->removeElement($session);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getToSessions()
    {
        return $this->toSessions;
    }

    /**
     * @param ArrayCollection $toSessions
     * @return User
     */
    public function setToSessions($toSessions)
    {
        $this->toSessions = $toSessions;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getFromSessions()
    {
        return $this->fromSessions;
    }

    /**
     * @param ArrayCollection $fromSessions
     * @return User
     */
    public function setFromSessions($fromSessions)
    {
        $this->fromSessions = $fromSessions;
        return $this;
    }

    /**
     * @param Session $session
     * @return $this
     */
    public function addFromSession(Session $session)
    {
        $this->fromSessions->add($session);

        return $this;
    }

    /**
     * @param Session $session
     * @return $this
     */
    public function removeFromSession(Session $session)
    {
        $this->fromSessions->removeElement($session);

        return $this;
    }
}
