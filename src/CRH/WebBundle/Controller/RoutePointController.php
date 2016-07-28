<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CRH\WebBundle\Entity\RoutePoint;
use CRH\WebBundle\Form\RoutePointType;
use CRH\WebBundle\Entity\Trail;
use CRH\WebBundle\Entity\POI_TYPE;

/**
 * RoutePoint controller.
 *
 * @Route("/admin/routepoint")
 */
class RoutePointController extends Controller
{
    /**
     * Creates a new RoutePoint entity.
     *
     * @Route("/{trail}/create", name="admin_routepoint_create")
     * @Method({"POST"})
     */
    public function ajaxAction(Request $request, Trail $trail)
    {
        $data = $request->request->all();
        $data = json_decode($data['data']);
        
       // dump($data);
        $response ="";
        
        $em = $this->getDoctrine()->getManager();
        
        //delete existing
        
        $existing = $em->getRepository('CRHWebBundle:RoutePoint')->findBy(array('trail' => $trail->getId()));
        
        //dump($existing);
        
        foreach($existing as $rp)
        {
            $em->remove($rp);
        }

        foreach($data as $routePoint)
        {
            $rp = new RoutePoint();
            $rp->setStartLat($routePoint->startLat);
            $rp->setStartLng($routePoint->startLng);
            $rp->setEndLat($routePoint->endLat);
            $rp->setEndLng($routePoint->endLng);
            $rp->setTrail($trail);
            $em->persist($rp);
        }
        
        $em->flush();
        
        return new Response($response);
    }


    /**
     * Creates a new RoutePoint entity.
     *
     * @Route("/{trail}/new", name="admin_routepoint_new")
     * @Method({"GET"})
     */

    public function newAction(Request $request, Trail $trail)
    {
        $em = $this->getDoctrine()->getManager();
        $poi = $em->getRepository('CRHWebBundle:POI_TYPE')->findAll();
        
        return $this->render('routepoint/new.html.twig', array(
            'trail' => $trail,
            'poiType' => $poi
        ));
    }


}
