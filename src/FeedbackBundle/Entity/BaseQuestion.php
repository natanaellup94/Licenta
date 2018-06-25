<?php

namespace FeedbackBundle\Entity;

use UserBundle\Entity\Group;

class BaseQuestion
{

    const COMMUNICATION_ABILITY = 1;
    const COMMUNICATION_ABILITY_LABEL = 'Communication';

    const KNOWLEDGE_ABILITY = 2;
    const KNOWLEDGE_ABILITY_LABEL = 'Knowledge';

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
     * @var integer
     */
    private $weight;

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
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return BaseQuestion
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
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
            self::COMMUNICATION_ABILITY => self::COMMUNICATION_ABILITY_LABEL,
            self::KNOWLEDGE_ABILITY     => self::KNOWLEDGE_ABILITY_LABEL
        );
    }
}