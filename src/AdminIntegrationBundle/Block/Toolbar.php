<?php

namespace AdminIntegrationBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Sonata\BlockBundle\Block\BlockContextInterface;
use FrameworkExtensionBundle\Block\ApplicationBaseBlockService;
use MerchantsBundle\Application\InstallmentsFetcher;
use MerchantsBundle\Entity\UserMessage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * The user messages block manager.
 */
class Toolbar extends ApplicationBaseBlockService
{
    public function __construct($name, EngineInterface $templating)
    {
        parent::__construct($name, $templating);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'AdminIntegrationBundle:Block:toolbar.html.twig',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse(
            $blockContext->getTemplate(),
            array(),
            $response
        );
    }
}
