<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AcceuilController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppAdminBundle:Acceuil:index.html.twig');
    }

    public function counterAction() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppUserBundle:Client')->findAll();
        $offers = $em->getRepository('CoreBundle:Element')->findRequestsOrOffers('Offer');
        $requests = $em->getRepository('CoreBundle:Element')->findRequestsOrOffers('Request');
        $repports = $em->getRepository('CoreBundle:Repport')->findAll();

        $result = [
            "count_users" => count($users),
            "count_offers" => count($offers),
            "count_requests" => count($requests),
            "count_repports" => count($repports)
        ];

        $response = new JsonResponse();
        return $response->setData([
            "response" => $result
        ]);
    }
}
