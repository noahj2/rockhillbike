<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CRH\WebBundle\Entity\Comment;

/**
 * Front Comment Controller
 * 
 * @Route("/comment") 
 */
 
 class FrontCommentController extends Controller
 {
     /**
      * List all approved comments 
      * 
      * @Route("/", name="comment_index")
      * @Method("GET")
      */ 
     
     public function indexAction()
     {
         $em = $this->getDoctrine()->getManager();
         
         $approvedComments = $em->getRepository('CRHWebBundle:Comment')->findByisApproved(true);
         
         return $this->render('frontcomment/index.html.twig', array(
            'comments' => $approvedComments,  
        ));
     }
 }
