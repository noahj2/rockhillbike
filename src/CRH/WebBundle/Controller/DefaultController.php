<?php

namespace CRH\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $announcements = $em->getRepository('CRHWebBundle:Announcement')->findBy(array("isCurrent" => true), array("id" => "DESC"));
        $trailOfMonth = $em->getRepository('CRHWebBundle:Trail')->findOneBy(array("isTrailOfMonth" => true));
        $upcomingEvents = $em->getRepository('CRHWebBundle:Event')->getUpcomingEvents();
        $wellnessTipOfMonth = $em->getRepository('CRHWebBundle:WellnessTip')->findOneBy(array("isTipOfMonth" => true));
        $randomComment = $em->getRepository('CRHWebBundle:Comment')->getRandomComment();
        dump($randomComment);
    
        return $this->render(':default:index.html.twig', 
            array("announcements" => $announcements, 
                "trailOfMonth" => $trailOfMonth,
                'upcomingEvents' => $upcomingEvents,
                'wellnessTipOfMonth' => $wellnessTipOfMonth,
                'randomComment' => $randomComment
                ));
    }
    
     /**
     * @Route("/events")
     */
    public function eventsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $upcomingEvents = $em->getRepository('CRHWebBundle:Event')->getUpcomingEvents(10);
        $announcements = $em->getRepository('CRHWebBundle:Announcement')->findBy(array("isCurrent" => true), array("id" => "DESC"));
        $trailOfMonth = $em->getRepository('CRHWebBundle:Trail')->findOneBy(array("isTrailOfMonth" => true));
        $wellnessTipOfMonth = $em->getRepository('CRHWebBundle:WellnessTip')->findOneBy(array("isTipOfMonth" => true));
        
    
        return $this->render(':default:events.html.twig', 
            array("announcements" => $announcements, 
                "trailOfMonth" => $trailOfMonth,
                'upcomingEvents' => $upcomingEvents,
                'wellnessTipOfMonth' => $wellnessTipOfMonth
                ));
    }
    
        
     /**
     * @Route("/trails")
     */
    public function trailsAction()
    {
        $em = $this->getDoctrine()->getManager();

        
        $trails = $em->getRepository('CRHWebBundle:Trail')->findAll();
        $upcomingEvents = $em->getRepository('CRHWebBundle:Event')->getUpcomingEvents(10);
        $announcements = $em->getRepository('CRHWebBundle:Announcement')->findBy(array("isCurrent" => true), array("id" => "DESC"));
        $trailOfMonth = $em->getRepository('CRHWebBundle:Trail')->findOneBy(array("isTrailOfMonth" => true));
        $wellnessTipOfMonth = $em->getRepository('CRHWebBundle:WellnessTip')->findOneBy(array("isTipOfMonth" => true));
        $last10Comments = $em->getRepository('CRHWebBundle:Comment')->findBy(array(), array("id" => "DESC"), 10);
        
        
    
        return $this->render(':default:trailsGreenways.html.twig', 
            array("announcements" => $announcements, 
                "trails" => $trails,
                "trailOfMonth" => $trailOfMonth,
                'upcomingEvents' => $upcomingEvents,
                'wellnessTipOfMonth' => $wellnessTipOfMonth,
                'last10comments' => $last10Comments
                
                ));
    }
    
}


//Create the show more
