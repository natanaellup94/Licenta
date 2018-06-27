<?php

namespace FeedbackBundle\Entity;

use UserBundle\Entity\User;

class Session
{
    const NEW_STATUS        = 1;
    const FINALIZED_STATUS  = 2;

    const NEW_STATUS_LABEL          = 'new';
    const FINALIZED_STATUS_LABEL    = 'finalized';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var User
     */
    private $to;

    /**
     * @var User
     */
    private $from;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $added;

    /**
     * @var float
     */
    private $communicationAbilityAverage;

    /**
     * @var float
     */
    private $knowledgeShareAbilityAverage;

    /**
     * @var float
     */
    private $executionAbilityAverage;

    /**
     * @var float
     */
    private $takingOverResponsabilityAbilityAverage;

    /**
     * @var float
     */
    private $teamSpiritAbilityAverage;

    /**
     * @var float
     */
    private $openMindednessAbilityAverage;

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
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param User $to
     * @return Session
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
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
     * @return Session
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Session
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @return Session
     */
    public function setAdded($added)
    {
        $this->added = $added;
        return $this;
    }

    /**
     * @return float
     */
    public function getCommunicationAbilityAverage()
    {
        return $this->communicationAbilityAverage;
    }

    /**
     * @param float $communicationAbilityAverage
     * @return Session
     */
    public function setCommunicationAbilityAverage($communicationAbilityAverage)
    {
        $this->communicationAbilityAverage = $communicationAbilityAverage;
        return $this;
    }

    /**
     * @return float
     */
    public function getKnowledgeShareAbilityAverage()
    {
        return $this->knowledgeShareAbilityAverage;
    }

    /**
     * @param float $knowledgeShareAbilityAverage
     * @return Session
     */
    public function setKnowledgeShareAbilityAverage($knowledgeShareAbilityAverage)
    {
        $this->knowledgeShareAbilityAverage = $knowledgeShareAbilityAverage;
        return $this;
    }

    /**
     * @return float
     */
    public function getExecutionAbilityAverage()
    {
        return $this->executionAbilityAverage;
    }

    /**
     * @param float $executionAbilityAverage
     * @return Session
     */
    public function setExecutionAbilityAverage($executionAbilityAverage)
    {
        $this->executionAbilityAverage = $executionAbilityAverage;
        return $this;
    }

    /**
     * @return float
     */
    public function getTakingOverResponsabilityAbilityAverage()
    {
        return $this->takingOverResponsabilityAbilityAverage;
    }

    /**
     * @param float $takingOverResponsabilityAbilityAverage
     * @return Session
     */
    public function setTakingOverResponsabilityAbilityAverage($takingOverResponsabilityAbilityAverage)
    {
        $this->takingOverResponsabilityAbilityAverage = $takingOverResponsabilityAbilityAverage;
        return $this;
    }

    /**
     * @return float
     */
    public function getTeamSpiritAbilityAverage()
    {
        return $this->teamSpiritAbilityAverage;
    }

    /**
     * @param float $teamSpiritAbilityAverage
     * @return Session
     */
    public function setTeamSpiritAbilityAverage($teamSpiritAbilityAverage)
    {
        $this->teamSpiritAbilityAverage = $teamSpiritAbilityAverage;
        return $this;
    }

    /**
     * @return float
     */
    public function getOpenMindednessAbilityAverage()
    {
        return $this->openMindednessAbilityAverage;
    }

    /**
     * @param float $openMindednessAbilityAverage
     * @return Session
     */
    public function setOpenMindednessAbilityAverage($openMindednessAbilityAverage)
    {
        $this->openMindednessAbilityAverage = $openMindednessAbilityAverage;
        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getStatusLabel()
    {
        $labels = self::getStatusLabels();

        if(array_key_exists($this->getStatus(), $labels)){
            return $labels[$this->getStatus()];
        }

        return '';
    }

    /**
     * @return array
     */
    public static function getStatusLabels()
    {
        return [
            self::NEW_STATUS        => self::NEW_STATUS_LABEL,
            self::FINALIZED_STATUS  => self::FINALIZED_STATUS_LABEL
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if(!is_null($this->to) && !is_null($this->from)){
            return $this->to->getUsername().' -> '.$this->from->getUsername();
        }

        return '';
    }
}