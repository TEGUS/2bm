<?php

namespace App\AdminBundle\Controller;

use CoreBundle\Entity\Town;
use CoreBundle\Form\TownType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TownController extends Controller
{
    public function indexAction()
    {
        $town = new Town();
        $form = $this->createForm(new TownType(), $town);

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            $em->persist($town);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Ville crée avec succès!");
            return $this->redirect($this->generateUrl('app_admin_town'));
        }

        $town_list =  $em->getRepository('CoreBundle:Town')->findBy(array(),array('country' => 'ASC'));
        return $this->render('AppAdminBundle:Town:index.html.twig',
            [
                'form' => $form->createView(),
                'towns' => $town_list
            ]
        );
    }

    public function deleteAction(\CoreBundle\Entity\Town $town) {
        $em = $this->getDoctrine()->getEntityManager();
        try {
            $em->remove($town);
            $em->flush();
        } catch(ConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->Add('danger', "Vous ne pouvez pas supprimer cette ville!");
            return $this->redirect($this->generateUrl('app_admin_town'));
        }
        $this->get('session')->getFlashBag()->Add('success', "Ville supprimée avec succès!");
        return $this->redirect($this->generateUrl('app_admin_town'));
    }

    public function updateAction(\CoreBundle\Entity\Town $town) {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new TownType(), $town);
        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $em->merge($town);
            $em->flush();
            $this->get('session')->getFlashBag()->Add('success', "Cette Ville a été modifié avec succès!");
            return $this->redirect($this->generateUrl('app_admin_town'));
        }

        return $this->render('AppAdminBundle:Town:update.html.twig', [
            'form' => $form->createView(),
            'town' => $town
        ]);
    }
}
