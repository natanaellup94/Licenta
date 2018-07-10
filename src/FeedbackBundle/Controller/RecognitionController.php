<?php

namespace FeedbackBundle\Controller;

use FeedbackBundle\Entity\Recognition;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecognitionController extends Controller
{
    /**
     * Number of recognitions for page.
     */
    const NUMBER_OF_RECOGNITION_FOR_HOMEPAGE    = 3;

    /**
     * Number of recognition for a page.
     */
    const NUMBER_OF_RECOGNITION_FOR_A_PAGE      = 5;

    /**
     * List action.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listAction(Request $request)
    {
        $recognitionRepo = $this->getDoctrine()->getManager()->getRepository('FeedbackBundle:Recognition');
        $recognitions = $recognitionRepo->findBy(array(),
            array('added' => 'DESC'), self::NUMBER_OF_RECOGNITION_FOR_HOMEPAGE);

        $pageContent = $this->renderView('@Feedback/Recognition/show_recognitions.html.twig',
                array('recognitions' => $recognitions));

        return new JsonResponse(array(
            'pageContent' => $pageContent
        ));
    }

    /**
     * My recognitions page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function myRecognitionAction(Request $request)
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        if(is_null($currentUser)){
            return $this->createAccessDeniedException('Access denied');
        }

        $recognitionRepo        = $this->getDoctrine()->getManager()->getRepository('FeedbackBundle:Recognition');

        $receivedRecognitions   = $recognitionRepo->findBy(array('to' => $currentUser), array('added' => "DESC"));
        $sentRecognitions       = $recognitionRepo->findBy(array('from' => $currentUser), array('added' => "DESC"));

        return $this->render('@Feedback/Recognition/my_recognition.html.twig', array(
            'receivedRecognitions' => $receivedRecognitions,
            'sentRecognitions'     => $sentRecognitions )
        );
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

            return $this->redirectToRoute('show_my_recognition_action');
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

            return $this->redirectToRoute('show_my_recognition_action');
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

    /**
     * Show all company recognitions by pagination.
     *
     * @param Request $request
     * @param $page
     */
    public function companyRecognitionsAction(Request $request, $page)
    {
        // get recognition repository
        $recognitionRepo = $this->getDoctrine()->getManager()->getRepository('FeedbackBundle:Recognition');
        // get all recognitions from database
        $allRecognitions = $recognitionRepo->findAll();
        // initialize this variable by number of recognitions
        $noOfRecognitions = count($allRecognitions);
        // obtain available recognitions for current page
        $currentRecognitions = $recognitionRepo->findBy(
            array(), array('added' => 'DESC'), self::NUMBER_OF_RECOGNITION_FOR_A_PAGE, self::NUMBER_OF_RECOGNITION_FOR_A_PAGE * ($page - 1));

        // calculate number of pages for comapany recognitions
        if($noOfRecognitions % self::NUMBER_OF_RECOGNITION_FOR_A_PAGE){
            $noOfPages = ($noOfRecognitions / self::NUMBER_OF_RECOGNITION_FOR_A_PAGE) + 1;
        }else{
            $noOfPages = ($noOfRecognitions / self::NUMBER_OF_RECOGNITION_FOR_A_PAGE);
        }

        // render template for current page
        return $this->render('@Feedback/Recognition/company_recognitions.html.twig', array(
            'currentPage'           => $page,
            "noOfPages"             => $noOfPages,
            "currentRecognitions"   => $currentRecognitions
        ));
    }
}