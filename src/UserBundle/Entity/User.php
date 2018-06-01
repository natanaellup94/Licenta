<?php

namespace UserBundle\Entity;

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

    protected $groups;
}
