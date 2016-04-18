<?php

//Custom Admin Controller

namespace CRH\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
* @Route("/admin")
*/
class AdminController extends Controller
{
    /**
     * @Route("/")
     */
    public function adminAction()
    {
        return $this->render(":admin:index.html.twig");
    }
}