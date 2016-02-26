<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CRH\WebBundle\Entity\PointsOfInterest;
use CRH\WebBundle\Form\PointsOfInterestType;

/**
 * PointsOfInterest controller.
 *
 * @Route("/admin/pointsofinterest")
 */
class PointsOfInterestController extends Controller
{
    /**
     * Lists all PointsOfInterest entities.
     *
     * @Route("/", name="admin_pointsofinterest_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pointsOfInterests = $em->getRepository('CRHWebBundle:PointsOfInterest')->findAll();

        return $this->render('pointsofinterest/index.html.twig', array(
            'pointsOfInterests' => $pointsOfInterests,
        ));
    }

    /**
     * Creates a new PointsOfInterest entity.
     *
     * @Route("/new", name="admin_pointsofinterest_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pointsOfInterest = new PointsOfInterest();
        $form = $this->createForm('CRH\WebBundle\Form\PointsOfInterestType', $pointsOfInterest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pointsOfInterest);
            $em->flush();

            return $this->redirectToRoute('admin_pointsofinterest_show', array('id' => $pointsofinterest->getId()));
        }

        return $this->render('pointsofinterest/new.html.twig', array(
            'pointsOfInterest' => $pointsOfInterest,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PointsOfInterest entity.
     *
     * @Route("/{id}", name="admin_pointsofinterest_show")
     * @Method("GET")
     */
    public function showAction(PointsOfInterest $pointsOfInterest)
    {
        $deleteForm = $this->createDeleteForm($pointsOfInterest);

        return $this->render('pointsofinterest/show.html.twig', array(
            'pointsOfInterest' => $pointsOfInterest,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PointsOfInterest entity.
     *
     * @Route("/{id}/edit", name="admin_pointsofinterest_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PointsOfInterest $pointsOfInterest)
    {
        $deleteForm = $this->createDeleteForm($pointsOfInterest);
        $editForm = $this->createForm('CRH\WebBundle\Form\PointsOfInterestType', $pointsOfInterest);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pointsOfInterest);
            $em->flush();

            return $this->redirectToRoute('admin_pointsofinterest_edit', array('id' => $pointsOfInterest->getId()));
        }

        return $this->render('pointsofinterest/edit.html.twig', array(
            'pointsOfInterest' => $pointsOfInterest,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PointsOfInterest entity.
     *
     * @Route("/{id}", name="admin_pointsofinterest_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PointsOfInterest $pointsOfInterest)
    {
        $form = $this->createDeleteForm($pointsOfInterest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pointsOfInterest);
            $em->flush();
        }

        return $this->redirectToRoute('admin_pointsofinterest_index');
    }

    /**
     * Creates a form to delete a PointsOfInterest entity.
     *
     * @param PointsOfInterest $pointsOfInterest The PointsOfInterest entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PointsOfInterest $pointsOfInterest)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_pointsofinterest_delete', array('id' => $pointsOfInterest->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
