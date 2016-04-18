<?php

namespace CRH\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//SCRAP and integrate with RoutePoints

/**
 * Map controller.
 *
 * @Route("/admin/map")
 */
 
class MapController extends Controller
{
    /**
     * Show Map.
     *
     * @Route("/", name="admin_map_index")
     * @Method("GET")
     */
     public function indexAction()
     {
         return $this->render(":map:index.html.twig");
     }
}