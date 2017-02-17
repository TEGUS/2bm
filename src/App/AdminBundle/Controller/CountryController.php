<?php

namespace App\AdminBundle\Controller;

use CoreBundle\Entity\Country;
use CoreBundle\Form\CountryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CountryController extends Controller
{
    public function indexAction()
    {
        $country = new Country();
        $form = $this->createForm(new CountryType(), $country);

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            $em->persist($country);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Pays crée avec succès!");
            return $this->redirect($this->generateUrl('app_admin_country'));
        }

        $country_list =  $em->getRepository('CoreBundle:Country')->findBy(
            array(),
            array('name' => 'ASC')
        );
        return $this->render('AppAdminBundle:Country:index.html.twig',
            [
                'form' => $form->createView(),
                'countries' => $country_list
            ]
        );
    }

    public function deleteAction(\CoreBundle\Entity\Country $country) {
        $em = $this->getDoctrine()->getEntityManager();
        try {
            $em->remove($country);
            $em->flush();
        } catch(ConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->Add('danger', "Vous ne pouvez pas supprimer ce pays!");
            return $this->redirect($this->generateUrl('app_admin_country'));
        }
        $this->get('session')->getFlashBag()->Add('success', "Pays supprimé avec succès!");
        return $this->redirect($this->generateUrl('app_admin_country'));
    }

    public function updateAction(\CoreBundle\Entity\Country $country) {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new CountryType(), $country);
        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $em->merge($country);
            $em->flush();
            $this->get('session')->getFlashBag()->Add('success', "Ce Pays a été modifié avec succès!");
            return $this->redirect($this->generateUrl('app_admin_country'));
        }

        return $this->render('AppAdminBundle:Country:update.html.twig', [
            'form' => $form->createView(),
            'country' => $country
        ]);
    }

    public function AbleOrEnableAction(\CoreBundle\Entity\Country $country, $val) {
        $em = $this->getDoctrine()->getManager();

        $country->setActive($val);
        $em->merge($country);
        $em->flush();

        if ($val == 1) {
            $this->get('session')->getFlashBag()->Add('success', "Pays désactivé avec succès");
        } else {
            $this->get('session')->getFlashBag()->Add('success', "Pays activé avec succès");
        }
        return $this->redirect($this->generateUrl('app_admin_country'));
    }
}
