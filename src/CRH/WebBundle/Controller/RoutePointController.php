<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CRH\WebBundle\Entity\RoutePoint;
use CRH\WebBundle\Form\RoutePointType;

/**
 * RoutePoint controller.
 *
 * @Route("/admin/routepoint")
 */
class RoutePointController extends Controller
{
    /**
     * Lists all RoutePoint entities.
     *
     * @Route("/", name="admin_routepoint_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $routePoints = $em->getRepository('CRHWebBundle:RoutePoint')->findAll();

        return $this->render('routepoint/index.html.twig', array(
            'routePoints' => $routePoints,
        ));
    }

    /**
     * Creates a new RoutePoint entity.
     *
     * @Route("/new", name="admin_routepoint_new")
     * @Method({"GET", "POST"})
     */

    public function newAction(Request $request)
    {
        $routePoint = new RoutePoint();
        $form = $this->createForm('CRH\WebBundle\Form\RoutePointType', $routePoint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($routePoint);
            $em->flush();

            return $this->redirectToRoute('admin_routepoint_show', array('id' => $routepoint->getId()));
        }

        return $this->render('routepoint/new.html.twig', array(
            'routePoint' => $routePoint,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RoutePoint entity.
     *
     * @Route("/{id}", name="admin_routepoint_show")
     * @Method("GET")
     */
    public function showAction(RoutePoint $routePoint)
    {
        $deleteForm = $this->createDeleteForm($routePoint);

        return $this->render('routepoint/show.html.twig', array(
            'routePoint' => $routePoint,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RoutePoint entity.
     *
     * @Route("/{id}/edit", name="admin_routepoint_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RoutePoint $routePoint)
    {
        $deleteForm = $this->createDeleteForm($routePoint);
        $editForm = $this->createForm('CRH\WebBundle\Form\RoutePointType', $routePoint);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($routePoint);
            $em->flush();

            return $this->redirectToRoute('admin_routepoint_edit', array('id' => $routePoint->getId()));
        }

        return $this->render('routepoint/edit.html.twig', array(
            'routePoint' => $routePoint,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RoutePoint entity.
     *
     * @Route("/{id}", name="admin_routepoint_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RoutePoint $routePoint)
    {
        $form = $this->createDeleteForm($routePoint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($routePoint);
            $em->flush();
        }

        return $this->redirectToRoute('admin_routepoint_index');
    }

    /**
     * Creates a form to delete a RoutePoint entity.
     *
     * @param RoutePoint $routePoint The RoutePoint entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RoutePoint $routePoint)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_routepoint_delete', array('id' => $routePoint->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
