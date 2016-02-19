<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CRH\WebBundle\Entity\POI_TYPE;
use CRH\WebBundle\Form\POI_TYPEType;

/**
 * POI_TYPE controller.
 *
 * @Route("/poi_type")
 */
class POI_TYPEController extends Controller
{
    /**
     * Lists all POI_TYPE entities.
     *
     * @Route("/", name="poi_type_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pOI_TYPEs = $em->getRepository('CRHWebBundle:POI_TYPE')->findAll();

        return $this->render('poi_type/index.html.twig', array(
            'pOI_TYPEs' => $pOI_TYPEs,
        ));
    }

    /**
     * Creates a new POI_TYPE entity.
     *
     * @Route("/new", name="poi_type_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pOI_TYPE = new POI_TYPE();
        $form = $this->createForm('CRH\WebBundle\Form\POI_TYPEType', $pOI_TYPE);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pOI_TYPE);
            $em->flush();

            return $this->redirectToRoute('poi_type_show', array('id' => $poi_type->getId()));
        }

        return $this->render('poi_type/new.html.twig', array(
            'pOI_TYPE' => $pOI_TYPE,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a POI_TYPE entity.
     *
     * @Route("/{id}", name="poi_type_show")
     * @Method("GET")
     */
    public function showAction(POI_TYPE $pOI_TYPE)
    {
        $deleteForm = $this->createDeleteForm($pOI_TYPE);

        return $this->render('poi_type/show.html.twig', array(
            'pOI_TYPE' => $pOI_TYPE,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing POI_TYPE entity.
     *
     * @Route("/{id}/edit", name="poi_type_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, POI_TYPE $pOI_TYPE)
    {
        $deleteForm = $this->createDeleteForm($pOI_TYPE);
        $editForm = $this->createForm('CRH\WebBundle\Form\POI_TYPEType', $pOI_TYPE);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pOI_TYPE);
            $em->flush();

            return $this->redirectToRoute('poi_type_edit', array('id' => $pOI_TYPE->getId()));
        }

        return $this->render('poi_type/edit.html.twig', array(
            'pOI_TYPE' => $pOI_TYPE,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a POI_TYPE entity.
     *
     * @Route("/{id}", name="poi_type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, POI_TYPE $pOI_TYPE)
    {
        $form = $this->createDeleteForm($pOI_TYPE);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pOI_TYPE);
            $em->flush();
        }

        return $this->redirectToRoute('poi_type_index');
    }

    /**
     * Creates a form to delete a POI_TYPE entity.
     *
     * @param POI_TYPE $pOI_TYPE The POI_TYPE entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(POI_TYPE $pOI_TYPE)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('poi_type_delete', array('id' => $pOI_TYPE->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
