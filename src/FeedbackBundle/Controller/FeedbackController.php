<?php

namespace FeedbackBundle\Controller;

use FeedbackBundle\Entity\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FeedbackController extends Controller
{
    public function getActiveFeedbackSectionAction(Request $request)
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        if(is_null($currentUser)){
            return $this->createAccessDeniedException('Access denied');
        }

        $sessionRepo = $this->getDoctrine()->getManager()->getRepository('FeedbackBundle:Session');
        $activeSessions = $sessionRepo->findBy(array('status' => Session::NEW_STATUS, 'from' => $currentUser));

        $pageContentData = $this->renderView('@Feedback/Feedback/show_my_active_sessions.html.twig', array('activeSessions' => $activeSessions));

        return new JsonResponse(array('pageContent' => $pageContentData));
    }
}