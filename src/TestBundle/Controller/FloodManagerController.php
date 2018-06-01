<?php

namespace TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TestBundle\Form\TestForm;

class FloodManagerController extends Controller
{
    public function testFloodManagerAction(Request $request)
    {
        $form = $this->createForm(TestForm::class, null);

        $form->handleRequest($request);

        return $this->render('TestBundle:FloodManager:create.html.twig', array('form' => $form->createView()));
    }
}
