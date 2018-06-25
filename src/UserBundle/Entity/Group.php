<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;

/**
 * The User model.
 */
class Group extends BaseGroup
{
    /**
     * The unique identifier of the User model.
     *
     * @var int
     */
    protected $id;

    protected $users;

    /**
     * @var ArrayCollection
     */
    protected $baseQuestions;

    /**
     * Group constructor.
     * @param $name
     * @param array $roles
     */
    public function __construct($name, array $roles = array())
    {
        parent::__construct($name, $roles);

        $this->baseQuestions = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getBaseQuestions()
    {
        return $this->baseQuestions;
    }

    /**
     * @param $baseQuestions
     * @return $this
     */
    public function setBaseQuestions($baseQuestions)
    {
        $this->baseQuestions = $baseQuestions;

        return $this;
    }

    /**
     * @param $baseQuestion
     * @return $this
     */
    public function addBaseQuestion($baseQuestion)
    {
        $this->baseQuestions->add($baseQuestion);

        return $this;
    }

    /**
     * @param $baseQuestion
     * @return $this
     */
    public function removeBaseQuestion($baseQuestion)
    {
        $this->baseQuestions->removeElement($baseQuestion);

        return $this;
    }
}
