<?php

namespace CoreBundle\Controller;

use CoreBundle\Entity\Commentaire;
use CoreBundle\Entity\Element;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;

header('Access-Control-Allow-Origin: *');
class ApiCommentaireController extends FOSRestController
{

    /**
     * @Rest\View
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $req = json_decode($request->getContent(), true);

        $user = $em->getRepository("AppUserBundle:Client")->find($req['idUser']);
        $element = $em->getRepository("CoreBundle:Element")->find($req['idElement']);
        $text = $req['text'];

        $commentaire = new Commentaire();
        $commentaire->setElement($element);
        $commentaire->setUtilisateur($user);
        $commentaire->setText($text);

        $em->persist($commentaire);
        $em->flush();

        return $this->findByElementAction($req['idElement'], $req['limit']);
    }

    /**
     * @Rest\View
     */
    public function findByElementAction($idElement, $limit) {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository("CoreBundle:Commentaire")->findAllByElement($idElement, $limit);
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json', SerializationContext::create()->setGroups(array('view_comment')));
        return json_decode($data, true);
    }

    /**
     * @Rest\View
     */
    public function deleteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $req = json_decode($request->getContent(), true);

        $user = $em->getRepository("AppUserBundle:Client")->find($req['idUser']);
        $commentaire = $em->getRepository("CoreBundle:Commentaire")->find($req['idCommentaire']);

        $em->remove($commentaire);
        $em->flush();

        return true;
    }

    /**
     * @Rest\View
     */
    public function updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $req = json_decode($request->getContent(), true);

        $user = $em->getRepository("AppUserBundle:Client")->find($req['idUser']);
        $commentaire = $em->getRepository("CoreBundle:Commentaire")->find($req['idCommentaire']);
        $commentaire->setText($req['text']);

        $em->merge($commentaire);
        $em->flush();

        return true;
    }
}
