<?php

namespace FeedbackBundle\Controller;

use FeedbackBundle\Entity\Recognition;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecognitionController extends Controller
{

    public function listAction(Request $request)
    {

    }

    /**
     * Add recognition action.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $recognition        = new Recognition();
        $recognitionForm    = $this->get('feedback_bundle.form.recognition_handler');

        $form = $this->createForm($recognitionForm, $recognition);
        $form->handleRequest($request);

        if($form->isValid()){
            $recognition = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($recognition);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('@Feedback/Recognition/add_recognition_page.html.twig', array('form' => $form->createView()));
    }

    /**
     * Edit recognition action.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $recognition = $em->getRepository('FeedbackBundle:Recognition')->find($id);

        if(is_null($recognition)){
            throw new NotFoundHttpException('Selected recognition does not exist!');
        }

        $recognitionForm = $this->get('feedback_bundle.form.recognition_handler');

        $form = $this->createForm($recognitionForm, $recognition);
        $form->handleRequest($request);

        if($form->isValid()){
            $recognition = $form->getData();

            $em->persist($recognition);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('@Feedback/Recognition/edit_recognition_page.html.twig', array('form' => $form->createView()));
    }

    /**
     * Remove action.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function removeAction(Request $request)
    {
        $recognitionId = $request->query->get('recognition_id');

        $em = $this->getDoctrine()->getManager();
        $recognitionRepo = $em->getRepository('FeedbackBundle:Recognition');

        $recognition = $recognitionRepo->find($recognitionId);

        $em->remove($recognition);
        $em->flush();

        return new JsonResponse(array(
            'success' => true
        ));
    }
}