<?php

namespace FeedbackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GoalController extends Controller
{
    /**
     * Show my goals action.
     *
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function showMyGoalsAction(Request $request)
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        if(is_null($currentUser)){
            return $this->createAccessDeniedException('Access denied');
        }

        $goalRepo = $this->getDoctrine()->getManager()->getRepository('FeedbackBundle:Goal');
        $goals = $goalRepo->findBy(array('user' => $currentUser));

        $pageContent = $this->renderView('FeedbackBundle:Goal:show_my_goals.html.twig', array('goals' => $goals));

        return new JsonResponse([
            'pageContent' => $pageContent
        ]);
    }
}