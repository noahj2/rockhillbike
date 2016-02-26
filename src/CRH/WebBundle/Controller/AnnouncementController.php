<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CRH\WebBundle\Entity\Announcement;
use CRH\WebBundle\Form\AnnouncementType;

/**
 * Announcement controller.
 *
 * @Route("/admin/announcement")
 */
class AnnouncementController extends Controller
{
    /**
     * Lists all Announcement entities.
     *
     * @Route("/", name="announcement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $announcements = $em->getRepository('CRHWebBundle:Announcement')->findAll();

        return $this->render('announcement/index.html.twig', array(
            'announcements' => $announcements,
        ));
    }

    /**
     * Creates a new Announcement entity.
     *
     * @Route("/new", name="announcement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $announcement = new Announcement();
        $form = $this->createForm('CRH\WebBundle\Form\AnnouncementType', $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($announcement);
            $em->flush();

            return $this->redirectToRoute('announcement_show', array('id' => $announcement->getId()));
        }

        return $this->render('announcement/new.html.twig', array(
            'announcement' => $announcement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Announcement entity.
     *
     * @Route("/{id}", name="announcement_show")
     * @Method("GET")
     */
    public function showAction(Announcement $announcement)
    {
        $deleteForm = $this->createDeleteForm($announcement);

        return $this->render('announcement/show.html.twig', array(
            'announcement' => $announcement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Announcement entity.
     *
     * @Route("/{id}/edit", name="announcement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Announcement $announcement)
    {
        $deleteForm = $this->createDeleteForm($announcement);
        $editForm = $this->createForm('CRH\WebBundle\Form\AnnouncementType', $announcement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($announcement);
            $em->flush();

            return $this->redirectToRoute('announcement_edit', array('id' => $announcement->getId()));
        }

        return $this->render('announcement/edit.html.twig', array(
            'announcement' => $announcement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Announcement entity.
     *
     * @Route("/{id}", name="announcement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Announcement $announcement)
    {
        $form = $this->createDeleteForm($announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($announcement);
            $em->flush();
        }

        return $this->redirectToRoute('announcement_index');
    }

    /**
     * Creates a form to delete a Announcement entity.
     *
     * @param Announcement $announcement The Announcement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Announcement $announcement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('announcement_delete', array('id' => $announcement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
