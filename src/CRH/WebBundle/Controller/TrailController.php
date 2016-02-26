<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CRH\WebBundle\Entity\Trail;
use CRH\WebBundle\Form\TrailType;

/**
 * Trail controller.
 *
 * @Route("/admin/trail")
 */
class TrailController extends Controller
{
    /**
     * Lists all Trail entities.
     *
     * @Route("/", name="admin_trail_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trails = $em->getRepository('CRHWebBundle:Trail')->findAll();

        return $this->render('trail/index.html.twig', array(
            'trails' => $trails,
        ));
    }

    /**
     * Creates a new Trail entity.
     *
     * @Route("/new", name="admin_trail_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $trail = new Trail();
        $form = $this->createForm('CRH\WebBundle\Form\TrailType', $trail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trail);
            $em->flush();

            return $this->redirectToRoute('admin_trail_show', array('id' => $trail->getId()));
        }

        return $this->render('trail/new.html.twig', array(
            'trail' => $trail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Trail entity.
     *
     * @Route("/{id}", name="admin_trail_show")
     * @Method("GET")
     */
    public function showAction(Trail $trail)
    {
        $deleteForm = $this->createDeleteForm($trail);

        return $this->render('trail/show.html.twig', array(
            'trail' => $trail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Trail entity.
     *
     * @Route("/{id}/edit", name="admin_trail_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Trail $trail)
    {
        $deleteForm = $this->createDeleteForm($trail);
        $editForm = $this->createForm('CRH\WebBundle\Form\TrailType', $trail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trail);
            $em->flush();

            return $this->redirectToRoute('admin_trail_edit', array('id' => $trail->getId()));
        }

        return $this->render('trail/edit.html.twig', array(
            'trail' => $trail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Trail entity.
     *
     * @Route("/{id}", name="admin_trail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Trail $trail)
    {
        $form = $this->createDeleteForm($trail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trail);
            $em->flush();
        }

        return $this->redirectToRoute('admin_trail_index');
    }

    /**
     * Creates a form to delete a Trail entity.
     *
     * @param Trail $trail The Trail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Trail $trail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_trail_delete', array('id' => $trail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
