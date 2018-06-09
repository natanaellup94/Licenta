<?php

namespace FeedbackBundle\Entity;

use UserBundle\Entity\User;

class Recognition
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var User
     */
    protected $from;

    /**
     * @var User
     */
    protected $to;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \DateTime
     */
    protected $added;

    /**
     * @var RecognitionType
     */
    protected $type;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param User $from
     * @return Recognition
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return User
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param User $to
     * @return Recognition
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Recognition
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @param \DateTime $added
     * @return Recognition
     */
    public function setAdded($added)
    {
        $this->added = $added;
        return $this;
    }

    /**
     * @return RecognitionType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param RecognitionType $type
     * @return Recognition
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}