<?php

namespace CoreBundle\Controller;

use App\UserBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

header('Access-Control-Allow-Origin: *');
class ApiCategorieController extends FOSRestController
{
    /**
     * @Rest\View
     */
    public function allCategoriesAction() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository("CoreBundle:Categorie")->findAll();
    }
}
