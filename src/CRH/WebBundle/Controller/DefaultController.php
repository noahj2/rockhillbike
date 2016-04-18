<?php

namespace CRH\WebBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CRH\WebBundle\Entity\Comment;
use CRH\WebBundle\Form\CommentType;


class DefaultController extends Controller
{
    
    
    
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();

        $announcements = $em->getRepository('CRHWebBundle:Announcement')->findBy(array("isCurrent" => true), array("id" => "DESC"));
        $trailOfMonth = $em->getRepository('CRHWebBundle:Trail')->findOneBy(array("isTrailOfMonth" => true));
        $upcomingEvents = $em->getRepository('CRHWebBundle:Event')->getUpcomingEvents(1);
        $wellnessTipOfMonth = $em->getRepository('CRHWebBundle:WellnessTip')->findOneBy(array("isTipOfMonth" => true));
        $randomComment = $em->getRepository('CRHWebBundle:Comment')->getRandomComment();

        
        $commentForm = $this->commentForm($request);
        
    
        return $this->render(':default:index.html.twig', 
            array("announcements" => $announcements, 
                "trailOfMonth" => $trailOfMonth,
                'upcomingEvents' => $upcomingEvents,
                'wellnessTipOfMonth' => $wellnessTipOfMonth,
                'randomComment' => $randomComment,
                'commentForm' => $commentForm->createView()
                ));
    }
    
     /**
     * @Route("/events", name="events")
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
     * @Route("/trails", name="trails")
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
    
    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        //$em = $this->getDoctrine()->getManager();
        
        return $this->render(':default:about.html.twig');
    }
    
    /**
     * @Route("/involved", name="involved")
     */
    public function involvedAction()
    {
     //  $em = $this->getDoctrine()->getManager();
        
        return $this->render(':default:involved.html.twig');
    }
    
    
    
    
         /**
      * List all approved comments 
      * 
      * @Route("/comment", name="comment_index")
      * @Method("GET")
      */ 
     
     public function commentIndexAction()
     {
         $em = $this->getDoctrine()->getManager();
         
         $approvedComments = $em->getRepository('CRHWebBundle:Comment')->findByisApproved(true);
         
         return $this->render('frontcomment/index.html.twig', array(
            'comments' => $approvedComments,  
        ));
     }
     

      
      
      
          
     /**
     * @Route("/comment/pending", name="comment_pending")
     */
    public function commentPendingAction()
    {
     //  $em = $this->getDoctrine()->getManager();
        
        return $this->render(':default:commentPending.html.twig');
    }
    
    
    /**
     * Creates a new Comment entity.
     *
     * @Route("/comment/new", name="comment_new")
     * @Method({"GET", "POST"})
     */
    public function commentNewAction(Request $request)
    {

        $commentForm = $this->commentForm($request);
        

        return $this->render('default/commentNew.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(),
        ));
    }
    
    
    public function commentForm(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm('CRH\WebBundle\Form\CommentType', $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('comment_pending');
        }
        
        
        $args['form'] = $form->createView();
        
        return $args;
    }