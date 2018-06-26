<?php

namespace FeedbackBundle\Controller;

use FeedbackBundle\Entity\Goal;
use FeedbackBundle\Form\GoalHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        // get goal id from current request
        $goalId = $request->query->get('goal_id');

        // obtain goal repository
        $em = $this->getDoctrine()->getManager();
        $goalRepo = $em->getRepository('FeedbackBundle:Goal');

        // get current goal for remove action
        $goal = $goalRepo->find($goalId);

        // remove goal from datastore
        $em->remove($goal);
        $em->flush();

        // return JsonResponse for JavaScript Ajax request with success value true
        return new JsonResponse(array(
            'success' => true
        ));
    }

    /**
     * Edit goal action.
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editGoalAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $goal = $em->getRepository('FeedbackBundle:Goal')->find($id);

        if(is_null($goal)){
            throw new NotFoundHttpException('Selected goal does not exist!');
        }

        $form = $this->createForm(new GoalHandler(), $goal);
        $form->handleRequest($request);

        if($form->isValid()){
            $goal = $form->getData();
            $this->initGoal($goal);

            $em->persist($goal);
            $em->flush();

            return $this->redirectToRoute('show_goals_page');
        }

        return $this->render('@Feedback/Goal/edit_goal_page.html.twig', array('form' => $form->createView()));
    }

    /**
     * Add goal action.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addGoalAction(Request $request)
    {
        // create a goal object
        $goal = new Goal();

        // create form for goal handler(create/edit)
        $form = $this->createForm(new GoalHandler(), $goal);
        // form handler request. Prepare form based on current form.
        $form->handleRequest($request);

        // if form is valid and submitted save new goals
        if($form->isValid()){
            $goal = $form->getData();
            // set date date and asign current user
            $this->initGoal($goal);

            // persist in database new goal
            $em = $this->getDoctrine()->getManager();
            $em->persist($goal);
            $em->flush();
            // redirect user to show my goals page
            return $this->redirectToRoute('show_goals_page');
        }

        // if form is not valid or not submitted render add new goal
        return $this->render('@Feedback/Goal/add_goal_page.html.twig', array('form' => $form->createView()));
    }

    /**
     * Init a goal object.
     *
     * @param Goal $goal
     */
    private function initGoal(Goal $goal)
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        $goal->setUser($currentUser);
        $goal->setProgress($goal->getProgress() ?? 0);
    }
}