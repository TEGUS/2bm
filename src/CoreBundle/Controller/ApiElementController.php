<?php

namespace CoreBundle\Controller;

use CoreBundle\Entity\Element;
use CoreBundle\Entity\Picture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;

header('Access-Control-Allow-Origin: *');
class ApiElementController extends FOSRestController
{

    public function getCurrentClientAction($id) {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository("AppUserBundle:Client")->find($id);
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json', SerializationContext::create()->setGroups(array('view_client')));
        return json_decode($data, true);
    }

    /**
     * @Rest\View
     */
    public function allElementAction($idTown, $limit) {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository("CoreBundle:Element")->findAllElement($idTown, $limit);
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json', SerializationContext::create()->setGroups(array('findAllElement')));
        return json_decode($data, true);
    }

    /**
     * @Rest\View
     */
    public function allElementByUserAction($idUser, $type, $limit) {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository("CoreBundle:Element")->findAllElementByUser($idUser, $type, $limit);
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json', SerializationContext::create()->setGroups(array('findAllElement')));
        return json_decode($data, true);
    }

    /**
     * @Rest\View
     */
    public function allRequestAction($idTown, $limit) {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository("CoreBundle:Element")->findAllRequest($idTown, $limit);
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json', SerializationContext::create()->setGroups(array('findAllElement')));
        return json_decode($data, true);
    }

    /**
     * @Rest\View
     */
    public function allOfferAction($idTown, $limit) {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository("CoreBundle:Element")->findAllOffer($idTown, $limit);
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json', SerializationContext::create()->setGroups(array('findAllElement')));
        return json_decode($data, true);
    }

    /**
     * @Rest\View
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $req = json_decode($request->getContent(), true);

        $user = $em->getRepository("AppUserBundle:Client")->find($req['idUser']);
        $categorie = $em->getRepository("CoreBundle:Categorie")->find($req['categorie']);
        $type = $em->getRepository("CoreBundle:Type")->findOneBy([
            'libelle' => $req['type']
        ]);

        $element = new Element();
        $element->setCategorie($categorie);
        $element->setType($type);
        $element->setUtilisateur($user);
        $element->setLibelle($req['libelle']);
        $element->setPrix($req['prix']);
        $element->setDescription($req['description']);
        $element->setVisible($req['visible']);

        $em->persist($element);
        $em->flush();

        $pictures = $req['pictures'];
        for($i = 0; $i < count($pictures); $i++) {
            $picture = new Picture();
            $picture->setPath($pictures[$i]["path"]);
            $picture->setElement($element);

            $em->persist($picture);
            $em->flush();
        }

        return $this->getCurrentClientAction($req['idUser']);
    }

    /**
     * @Rest\View
     */
    public function deleteAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idElement = urldecode($request->request->get('idElement'));
        $idUtilisateur = urldecode($request->request->get('idUser'));
        $type = urldecode($request->request->get('type'));
        $limit = urldecode($request->request->get('limit'));

        $element = $em->getRepository("CoreBundle:Element")->find($idElement);

        $em->remove($element);
        $em->flush();

        return $this->allElementByUserAction($idUtilisateur, $type, $limit);
    }

    /**
     * @Rest\View
     */
    public function updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $req = json_decode($request->getContent(), true);

        $idElement = $req['idElement'];

//        Delete all pictures of element

        $allPictures = $em->getRepository("CoreBundle:Picture")->findByElement($idElement);
        for($i = 0; $i < count($allPictures); $i++) {
            $em->remove($allPictures[$i]);
            $em->flush();
        }

//        Update Element now
        $categorie = $em->getRepository("CoreBundle:Categorie")->find($req['categorie']);
        $element = $em->getRepository("CoreBundle:Element")->find($idElement);
        $element->setCategorie($categorie);
        $element->setLibelle($req['libelle']);
        $element->setDescription($req['description']);
        $element->setPrix($req['prix']);
        $element->setDateCreation(new\ DateTime);

        $em->merge($element);
        $em->flush();

        $pictures = $req['pictures'];
        for($i = 0; $i < count($pictures); $i++) {
            $picture = new Picture();
            $picture->setPath($pictures[$i]["path"]);
            $picture->setElement($element);

            $em->persist($picture);
            $em->flush();
        }

        return $this->getCurrentClientAction($req['idUser']);
    }

    /**
     * @Rest\View
     */
    public function shareAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idElement = urldecode($request->request->get('idElement'));
        $idUtilisateur = urldecode($request->request->get('idUser'));
        $val = urldecode($request->request->get('val'));

        $element = $em->getRepository("CoreBundle:Element")->find($idElement);
        $element->setPartager($val);
        $element->setDateCreation(new\ DateTime);

        $em->merge($element);
        $em->flush();

        return $this->getCurrentClientAction($idUtilisateur);
    }

    /**
     * @Rest\View
     */
    public function visibleAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idElement = urldecode($request->request->get('idElement'));
        $idUtilisateur = urldecode($request->request->get('idUser'));
        $type = urldecode($request->request->get('type'));
        $limit = urldecode($request->request->get('limit'));
        $val = urldecode($request->request->get('val'));

        $element = $em->getRepository("CoreBundle:Element")->find($idElement);
        $element->setVisible($val);
        $element->setDateCreation(new\ DateTime);

        $em->merge($element);
        $em->flush();

        return $this->allElementByUserAction($idUtilisateur, $type, $limit);
    }

    /**
     * @Rest\View
     */
    public function refreshDateAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idElement = urldecode($request->request->get('idElement'));
        $idUtilisateur = urldecode($request->request->get('idUser'));
        $type = urldecode($request->request->get('type'));
        $limit = urldecode($request->request->get('limit'));

        $element = $em->getRepository("CoreBundle:Element")->find($idElement);
        $element->setDateCreation(new\ DateTime);

        $em->merge($element);
        $em->flush();

        return $this->allElementByUserAction($idUtilisateur, $type, $limit);
    }
}
