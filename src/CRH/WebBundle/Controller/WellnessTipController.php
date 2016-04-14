<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CRH\WebBundle\Entity\WellnessTip;
use CRH\WebBundle\Form\WellnessTipType;

/**
 * WellnessTip controller.
 *
 * @Route("/admin/wellnesstip")
 */
class WellnessTipController extends Controller
{
    /**
     * Lists all WellnessTip entities.
     *
     * @Route("/", name="admin_wellnesstip_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $wellnessTips = $em->getRepository('CRHWebBundle:WellnessTip')->findAll();

        return $this->render('wellnesstip/index.html.twig', array(
            'wellnessTips' => $wellnessTips,
        ));
    }

    /**
     * Creates a new WellnessTip entity.
     *
     * @Route("/new", name="admin_wellnesstip_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $wellnessTip = new WellnessTip();
        $form = $this->createForm('CRH\WebBundle\Form\WellnessTipType', $wellnessTip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wellnessTip);
            
            if($wellnessTip->getIsTipOfMonth() == true)
            {
                $currentWellnessTips = $em->getRepository('CRHWebBundle:WellnessTip')->findBy(array("isTipOfMonth"=>true));
                foreach($currentWellnessTips as $currentWellnessTip)
                {
                    $currentWellnessTip->setIsTipOfMonth(false);
                }
            }
            
            
            $em->flush();

            return $this->redirectToRoute('admin_wellnesstip_show', array('id' => $wellnessTip->getId()));
        }

        return $this->render('wellnesstip/new.html.twig', array(
            'wellnessTip' => $wellnessTip,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a WellnessTip entity.
     *
     * @Route("/{id}", name="admin_wellnesstip_show")
     * @Method("GET")
     */
    public function showAction(WellnessTip $wellnessTip)
    {
        $deleteForm = $this->createDeleteForm($wellnessTip);

        return $this->render('wellnesstip/show.html.twig', array(
            'wellnessTip' => $wellnessTip,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing WellnessTip entity.
     *
     * @Route("/{id}/edit", name="admin_wellnesstip_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, WellnessTip $wellnessTip)
    {
        $deleteForm = $this->createDeleteForm($wellnessTip);
        $editForm = $this->createForm('CRH\WebBundle\Form\WellnessTipType', $wellnessTip);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wellnessTip);
            
            if($wellnessTip->getIsTipOfMonth() == true)
            {
                $currentWellnessTips = $em->getRepository('CRHWebBundle:WellnessTip')->findBy(array("isTipOfMonth"=>true));
                foreach($currentWellnessTips as $currentWellnessTip)
                {
                    $currentWellnessTip->setIsTipOfMonth(false);
                }
            }
            
            $em->flush();

            return $this->redirectToRoute('admin_wellnesstip_edit', array('id' => $wellnessTip->getId()));
        }

        return $this->render('wellnesstip/edit.html.twig', array(
            'wellnessTip' => $wellnessTip,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a WellnessTip entity.
     *
     * @Route("/{id}", name="admin_wellnesstip_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, WellnessTip $wellnessTip)
    {
        $form = $this->createDeleteForm($wellnessTip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wellnessTip);
            $em->flush();
        }

        return $this->redirectToRoute('admin_wellnesstip_index');
    }

    /**
     * Creates a form to delete a WellnessTip entity.
     *
     * @param WellnessTip $wellnessTip The WellnessTip entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(WellnessTip $wellnessTip)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_wellnesstip_delete', array('id' => $wellnessTip->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
