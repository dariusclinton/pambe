<?php
/**
 * Created by PhpStorm.
 * User: Aurelien KOUAM
 * Date: 21/10/2016
 * Time: 06:29
 */

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WS\UserBundle\Entity\Category;
use WS\UserBundle\Form\CategoryType;

class CategorieController extends Controller {

    public function indexAction()
    {
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            $category->getImage()->setDirectory("images");

            $em->persist($category);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Catégorie crée avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_category'));
        }

        $category_list =  $em->getRepository('WSUserBundle:Category')->findAll();

        return $this->render('WSAdminBundle:Categorie:index.html.twig',
            [
                'form' => $form->createView(),
                'categories' => $category_list
            ]
        );
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $category = $em->getRepository('WSUserBundle:Category')->find($id);
        try {
            $em->remove($category);
            $em->flush();
        } catch(ConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->Add('danger', "Vous ne pouvez pas supprimer cette catégorie!");
            return $this->redirect($this->generateUrl('ws_admin_category'));
        }
        $this->get('session')->getFlashBag()->Add('success', "Catégorie supprimée avec succès!");
        return $this->redirect($this->generateUrl('ws_admin_category'));
    }

    public function updateAction($id) {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('WSUserBundle:Category')->find($id);

        $form = $this->createForm(new CategoryType(), $category);

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $category->getImage()->setDirectory("images");

            $em->merge($category);
            $em->flush();
            $this->get('session')->getFlashBag()->Add('success', "Cette Catégorie a été modifié avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_category'));
        }

        return $this->render('WSAdminBundle:Categorie:update.html.twig', [
            'form' => $form->createView(),
            'category' => $category
        ]);
    }
}