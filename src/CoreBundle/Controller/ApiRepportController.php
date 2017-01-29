<?php

namespace CoreBundle\Controller;

use App\UserBundle\Entity\Client;
use CoreBundle\Entity\Repport;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

header('Access-Control-Allow-Origin: *');
class ApiRepportController extends FOSRestController
{
    /**
     * @Rest\View
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $req = json_decode($request->getContent(), true);

        $user = $em->getRepository("AppUserBundle:Client")->find($req['idUser']);

        $repport = new Repport();
        $repport->setContent($req['content']);
        $repport->setUtilisateur($user);

        $em->persist($repport);
        $em->flush();

        return true;
    }

    public function findAllRepportsAction() {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('CoreBundle:Repport')->findAll();
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json', SerializationContext::create()->setGroups(array('findAllRepports')));
        return json_decode($data, true);
    }
}
