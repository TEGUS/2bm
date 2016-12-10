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
class ApiClientController extends FOSRestController
{

    /**
     * @Rest\View
     */
    public function testAction() {
        return true;
    }

    /**
     * @Rest\View
     */
    public function loginAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $telephone = urldecode($request->request->get('telephone'));
        $client = $em->getRepository("AppUserBundle:Client")->findBy(array(
            "telephone" => $telephone
        ));

        return $client[0];
    }

    /**
     * @Rest\View
     */
    public function registerAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $username = urldecode($request->request->get('username'));
        $telephone = urldecode($request->request->get('telephone'));
        $image = urldecode($request->request->get('pathImage'));
        $town = urldecode($request->request->get('town'));

        $client = new Client();
        $client->setUsername($username);
        $client->setUsernameCanonical($username);
        $client->setEmail($username.'@2bm.cm');
        $client->setEmailCanonical($username.'@2bm.cm');
        $client->setPlainPassword($telephone);
        $client->setEnabled(1);
        $client->setTelephone($telephone);
        $client->setTown($em->getRepository("CoreBundle:Town")->find($town));
        $client->setPathImage(str_replace(" ", "+", $image));

        $em->persist($client);
        $em->flush();

        $result = $em->getRepository("AppUserBundle:Client")->findBy(array(
            "telephone" => $telephone
        ));

        return $result[0];
    }

    /**
     * @Rest\View
     */
    public function updateUsernameAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idUtilisateur = urldecode($request->request->get('idUser'));
        $username = urldecode($request->request->get('username'));

        $client = $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
        $client->setUsername($username);
        $client->setUsernameCanonical($username);
        $client->setEmail($username.'@2bm.cm');
        $client->setEmailCanonical($username.'@2bm.cm');

        $em->merge($client);
        $em->flush();

        return $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
    }

    /**
     * @Rest\View
     */
    public function updatePhoneAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idUtilisateur = urldecode($request->request->get('idUser'));
        $telephone = urldecode($request->request->get('telephone'));

        $client = $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
        $client->setTelephone($telephone);

        $em->merge($client);
        $em->flush();

        return $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
    }

    /**
     * @Rest\View
     */
    public function updateTownAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idUtilisateur = urldecode($request->request->get('idUser'));
        $town = urldecode($request->request->get('town'));

        $client = $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
        $client->setTown($em->getRepository("CoreBundle:Town")->find($town));

        $em->merge($client);
        $em->flush();

        return $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
    }

    /**
     * @Rest\View
     */
    public function updateImageProfileAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idUtilisateur = urldecode($request->request->get('idUser'));
        $image = urldecode($request->request->get('pathImage'));

        $client = $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
        $client->setPathImage(str_replace(" ", "+", $image));

        $em->merge($client);
        $em->flush();

        $user = $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
        //$pathImage = $user->getPathImage();
        //$client->setPathImage(str_replace(" ", "+", $pathImage));

        return $user;
    }

    /**
     * @Rest\View
     */
    public function allClientAction() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository("AppUserBundle:Client")->findAll();
    }
}
