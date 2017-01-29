<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RepportController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AppAdminBundle:Repport:index.html.twig');
    }
}
