<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CRH\WebBundle\Entity\FitnessTip;
use CRH\WebBundle\Form\FitnessTipType;

/**
 * FitnessTip controller.
 *
 * @Route("/admin/fitnesstip")
 */
class FitnessTipController extends Controller
{
    /**
     * Lists all FitnessTip entities.
     *
     * @Route("/", name="admin_fitnesstip_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fitnessTips = $em->getRepository('CRHWebBundle:FitnessTip')->findAll();

        return $this->render('fitnesstip/index.html.twig', array(
            'fitnessTips' => $fitnessTips,
        ));
    }

    /**
     * Creates a new FitnessTip entity.
     *
     * @Route("/new", name="admin_fitnesstip_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fitnessTip = new FitnessTip();
        $form = $this->createForm('CRH\WebBundle\Form\FitnessTipType', $fitnessTip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fitnessTip);
            $em->flush();

            return $this->redirectToRoute('admin_fitnesstip_show', array('id' => $fitnesstip->getId()));
        }

        return $this->render('fitnesstip/new.html.twig', array(
            'fitnessTip' => $fitnessTip,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FitnessTip entity.
     *
     * @Route("/{id}", name="admin_fitnesstip_show")
     * @Method("GET")
     */
    public function showAction(FitnessTip $fitnessTip)
    {
        $deleteForm = $this->createDeleteForm($fitnessTip);

        return $this->render('fitnesstip/show.html.twig', array(
            'fitnessTip' => $fitnessTip,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FitnessTip entity.
     *
     * @Route("/{id}/edit", name="admin_fitnesstip_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FitnessTip $fitnessTip)
    {
        $deleteForm = $this->createDeleteForm($fitnessTip);
        $editForm = $this->createForm('CRH\WebBundle\Form\FitnessTipType', $fitnessTip);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fitnessTip);
            $em->flush();

            return $this->redirectToRoute('admin_fitnesstip_edit', array('id' => $fitnessTip->getId()));
        }

        return $this->render('fitnesstip/edit.html.twig', array(
            'fitnessTip' => $fitnessTip,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a FitnessTip entity.
     *
     * @Route("/{id}", name="admin_fitnesstip_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FitnessTip $fitnessTip)
    {
        $form = $this->createDeleteForm($fitnessTip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fitnessTip);
            $em->flush();
        }

        return $this->redirectToRoute('admin_fitnesstip_index');
    }

    /**
     * Creates a form to delete a FitnessTip entity.
     *
     * @param FitnessTip $fitnessTip The FitnessTip entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FitnessTip $fitnessTip)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fitnesstip_delete', array('id' => $fitnessTip->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
