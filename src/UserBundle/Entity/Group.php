<?php

namespace UserBundle\Entity;

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

}
