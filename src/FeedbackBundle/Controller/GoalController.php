<?php

namespace FeedbackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $goals = $goalRepo->getActiveGoal($currentUser);

        $pageContent = $this->renderView('@Feedback/Goal/show_my_goals_section.html.twig', array('goals' => $goals));

        return new JsonResponse([
            'pageContent' => $pageContent
        ]);
    }

    /**
     * All my goals page.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function myGoalsPageAction(Request $request)
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        if(is_null($currentUser)){
            return $this->createAccessDeniedException('Access denied');
        }

        $goalRepo = $this->getDoctrine()->getManager()->getRepository('FeedbackBundle:Goal');
        $goals = $goalRepo->getGoal($currentUser);

        return $this->render('FeedbackBundle:Goal:show_all_my_goals.html.twig', ['goals' => $goals]);
    }

    /**
     * Remove goal action.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function removeGoalAction(Request $request)
    {
        $goalId = $request->query->get('goal_id');

        $em = $this->getDoctrine()->getManager();
        $goalRepo = $em->getRepository('FeedbackBundle:Goal');

        $goal = $goalRepo->find($goalId);

        $em->remove($goal);
        $em->flush();

        return new JsonResponse(array(
            'success' => true
        ));
    }

    public function editGoalAction($id)
    {
        return new Response();
    }
}