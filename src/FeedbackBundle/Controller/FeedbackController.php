<?php

namespace FeedbackBundle\Controller;

use FeedbackBundle\Entity\BaseQuestion;
use FeedbackBundle\Entity\Session;
use FeedbackBundle\Form\SessionHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Group;

class FeedbackController extends Controller
{
    /**
     * Get active feedback session section.
     *
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
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

    /**
     * Session handler action.
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sessionHandlerAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sessionRepo = $em->getRepository('FeedbackBundle:Session');
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();
        $currentSession = $sessionRepo->find($id);

        if(is_null($currentUser) || $currentUser->getId() !== $currentSession->getFrom()->getId()){
            return $this->createAccessDeniedException('Access denied');
        }

        $form = $this->createForm(new SessionHandler(), $currentSession);
        $form->handleRequest($request);

        if($form->isValid()){
            $session = $form->getData();
            $session->setStatus(Session::FINALIZED_STATUS);

            $em->persist($session);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('@Feedback/Feedback/session_handler.html.twig', array(
            'form' => $form->createView(),
            'session' => $currentSession,
            'questions' => $this->getQuestions($currentSession->getTo()->getGroups()[0])
        ));
    }

    public function showSessionsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sessionRepo = $em->getRepository('FeedbackBundle:Session');
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        $finalizedSessions = $sessionRepo->findBy(array('to' => $currentUser, 'status' => Session::FINALIZED_STATUS));

        return $this->render('@Feedback/Feedback/show_my_feedback_page.html.twig', array(
            'finalizedSessions' => $finalizedSessions
        ));
    }

    public function currentUserScoreAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sessionRepo = $em->getRepository('FeedbackBundle:Session');
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        $finalizedSessions = $sessionRepo->findBy(array('to' => $currentUser, 'status' => Session::FINALIZED_STATUS));

        $sumOfPoints = array(
            BaseQuestion::COMMUNICATION_ABILITY_LABEL => 0,
            BaseQuestion::OPEN_MINDEDNESS_ABILITY_LABEL => 0,
            BaseQuestion::TEAM_SPIRIT_ABILITY_LABEL => 0,
            BaseQuestion::TAKING_OVER_RESPONSABILITY_ABILITY_LABEL => 0,
            BaseQuestion::EXECUTION_ABILITY_LABEL => 0,
            BaseQuestion::KNOWLEDGE_SHARING_ABILITY_LABEL => 0,
        );

        $noOfSession = array(
            BaseQuestion::COMMUNICATION_ABILITY_LABEL => 0,
            BaseQuestion::OPEN_MINDEDNESS_ABILITY_LABEL => 0,
            BaseQuestion::TEAM_SPIRIT_ABILITY_LABEL => 0,
            BaseQuestion::TAKING_OVER_RESPONSABILITY_ABILITY_LABEL => 0,
            BaseQuestion::EXECUTION_ABILITY_LABEL => 0,
            BaseQuestion::KNOWLEDGE_SHARING_ABILITY_LABEL => 0,
        );

        /** @var Session $finalizedSession */
        foreach ($finalizedSessions as $finalizedSession){
            if(!empty($finalizedSession->getCommunicationAbilityAverage())){
                $sumOfPoints[BaseQuestion::COMMUNICATION_ABILITY_LABEL] += $finalizedSession->getCommunicationAbilityAverage();
                $noOfSession[BaseQuestion::COMMUNICATION_ABILITY_LABEL]++;
            }

            if(!empty($finalizedSession->getOpenMindednessAbilityAverage())){
                $sumOfPoints[BaseQuestion::OPEN_MINDEDNESS_ABILITY_LABEL] += $finalizedSession->getOpenMindednessAbilityAverage();
                $noOfSession[BaseQuestion::OPEN_MINDEDNESS_ABILITY_LABEL]++;
            }

            if(!empty($finalizedSession->getTeamSpiritAbilityAverage())){
                $sumOfPoints[BaseQuestion::TEAM_SPIRIT_ABILITY_LABEL] += $finalizedSession->getTeamSpiritAbilityAverage();
                $noOfSession[BaseQuestion::TEAM_SPIRIT_ABILITY_LABEL]++;
            }

            if(!empty($finalizedSession->getTakingOverResponsabilityAbilityAverage())){
                $sumOfPoints[BaseQuestion::TAKING_OVER_RESPONSABILITY_ABILITY_LABEL] += $finalizedSession->getTakingOverResponsabilityAbilityAverage();
                $noOfSession[BaseQuestion::TAKING_OVER_RESPONSABILITY_ABILITY_LABEL]++;
            }

            if(!empty($finalizedSession->getExecutionAbilityAverage())){
                $sumOfPoints[BaseQuestion::EXECUTION_ABILITY_LABEL] += $finalizedSession->getExecutionAbilityAverage();
                $noOfSession[BaseQuestion::EXECUTION_ABILITY_LABEL]++;
            }

            if(!empty($finalizedSession->getKnowledgeShareAbilityAverage())){
                $sumOfPoints[BaseQuestion::KNOWLEDGE_SHARING_ABILITY_LABEL] += $finalizedSession->getKnowledgeShareAbilityAverage();
                $noOfSession[BaseQuestion::KNOWLEDGE_SHARING_ABILITY_LABEL]++;
            }
        }

        foreach ($sumOfPoints as $key => $sumOfPoint){
            if($noOfSession && $sumOfPoint){
                $results[$key] = $sumOfPoint / $noOfSession[$key];
            }else{
                $results[$key] = 0;
            }
        }

        return new JsonResponse($results);
    }

    /**
     * Get questions for current group.
     *
     * @param Group $group
     */
    private function getQuestions(Group $group)
    {
        $questionRepo   = $this->getDoctrine()->getManager()->getRepository('FeedbackBundle:BaseQuestion');
        $questionTypes  = BaseQuestion::getAbilityLabels();
        $questions      = array();

        foreach ($questionTypes as $type => $typeLabel){
            if(array_key_exists($typeLabel, $questions)){
                $questions[$typeLabel] = array();
            }
            $questions[$typeLabel] = $questionRepo->findBy(array('group' => $group, 'abilityType' => $type));
        }

        return $questions;
    }
}