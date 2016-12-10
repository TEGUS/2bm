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

header('Access-Control-Allow-Origin: *');
class ApiElementController extends FOSRestController
{

    /**
     * @Rest\View
     */
    public function allElementAction($idTown) {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository("CoreBundle:Element")->findAllElement($idTown);
    }

    /**
     * @Rest\View
     */
    public function createAction(Request $request) {
        //$request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $req = json_decode($request->getContent(), true);

        $user = $em->getRepository("AppUserBundle:Client")->find($req['idUser']);
        $categorie = $em->getRepository("CoreBundle:Categorie")->find($req['idCategorie']);

        $element = new Element();
        $element->setCategorie($categorie);
        $element->setUtilisateur($user);
        $element->setLibelle($req['libelle']);
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

        return $em->getRepository("AppUserBundle:Client")->find($req['idUser']);
    }

    /**
     * @Rest\View
     */
    public function deleteAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idElement = urldecode($request->request->get('idElement'));
        $idUtilisateur = urldecode($request->request->get('idUser'));

        $element = $em->getRepository("CoreBundle:Element")->find($idElement);

        $em->remove($element);
        $em->flush();

        return $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
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
        $element = $em->getRepository("CoreBundle:Element")->find($idElement);
        $element->setLibelle($req['libelle']);
        $element->setDescription($req['description']);
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

        return $em->getRepository("AppUserBundle:Client")->find($req['idUser']);
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

        return $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
    }

    /**
     * @Rest\View
     */
    public function visibleAction() {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $idElement = urldecode($request->request->get('idElement'));
        $idUtilisateur = urldecode($request->request->get('idUser'));
        $val = urldecode($request->request->get('val'));

        $element = $em->getRepository("CoreBundle:Element")->find($idElement);
        $element->setVisible($val);
        $element->setDateCreation(new\ DateTime);

        $em->merge($element);
        $em->flush();

        return $em->getRepository("AppUserBundle:Client")->find($idUtilisateur);
    }
}
