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
     
     /**
      * Creates a new unapproved comment entity
      * 
      * @Route("/new", name="comment_new")
      * @Method({"GET, POST")
      */ 
      
      public function newAction(Request $request)
      {
          $pendingComment = new Comment();
          $form = $this->createForm('CRH\WebBundle\Form\FrontCommentType', $pendingComment);
          $form->handleRequest($request);
          
          if($form->isSubmitted() & $form->isValid())
          {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pendingComment);
            $em->flush();              
            
            return $this->redirectToRoute('comment_index');
          }
          
        return $this->render('comment/new.html.twig', array(
            'comment' => $pendingComment,
            'form' => $form->createView(),
        ));          
      }
 }
