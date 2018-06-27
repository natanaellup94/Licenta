<?php

namespace FeedbackBundle\Entity;

use UserBundle\Entity\Group;

class BaseQuestion
{

    const COMMUNICATION_ABILITY = 1;
    const COMMUNICATION_ABILITY_LABEL = 'Communication';

    const KNOWLEDGE_SHARING_ABILITY = 2;
    const KNOWLEDGE_SHARING_ABILITY_LABEL = 'Knowledge sharing';

    const EXECUTION_ABILITY = 3;
    const EXECUTION_ABILITY_LABEL = 'Execution';

    const TAKING_OVER_RESPONSABILITY_ABILITY = 4;
    const TAKING_OVER_RESPONSABILITY_ABILITY_LABEL = 'Taking over responsability';

    const TEAM_SPIRIT_ABILITY = 5;
    const TEAM_SPIRIT_ABILITY_LABEL = 'Team spirit';

    const OPEN_MINDEDNESS_ABILITY = 6;
    const OPEN_MINDEDNESS_ABILITY_LABEL = 'Open mindedness';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var integer
     */
    private $abilityType;

    /**
     * @var Group
     */
    private $group;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return BaseQuestion
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return int
     */
    public function getAbilityType()
    {
        return $this->abilityType;
    }

    /**
     * @param int $abilityType
     * @return BaseQuestion
     */
    public function setAbilityType($abilityType)
    {
        $this->abilityType = $abilityType;
        return $this;
    }

    /**
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param Group $group
     * @return BaseQuestion
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getAbilityLabel()
    {
        $labels = self::getAbilityLabels();

        if(array_key_exists($this->getAbilityType(), $labels)){
            return $labels[$this->getAbilityType()];
        }

        return '';
    }

    /**
     * @return array
     */
    public static function getAbilityLabels()
    {
        return array(
            self::COMMUNICATION_ABILITY         => self::COMMUNICATION_ABILITY_LABEL,
            self::KNOWLEDGE_SHARING_ABILITY     => self::KNOWLEDGE_SHARING_ABILITY_LABEL,
            self::EXECUTION_ABILITY             => self::EXECUTION_ABILITY_LABEL,
            self::TAKING_OVER_RESPONSABILITY_ABILITY    => self::TAKING_OVER_RESPONSABILITY_ABILITY_LABEL,
            self::TEAM_SPIRIT_ABILITY           => self::TEAM_SPIRIT_ABILITY_LABEL,
            self::OPEN_MINDEDNESS_ABILITY       => self::OPEN_MINDEDNESS_ABILITY_LABEL
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if(!is_null($this->text)){
            return $this->text;
        }

        return '';
    }
}