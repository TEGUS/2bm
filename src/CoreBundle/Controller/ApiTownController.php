<?php

namespace CoreBundle\Controller;

use App\UserBundle\Entity\Client;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

header('Access-Control-Allow-Origin: *');
class ApiTownController extends FOSRestController
{
    /**
     * @Rest\View
     */
    public function allTownsAction($idCountry) {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository("CoreBundle:Town")->findBy([
           'country' => $idCountry
        ]);
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json', SerializationContext::create()->setGroups(array('findAllTowns')));
        return json_decode($data, true);
    }
}
