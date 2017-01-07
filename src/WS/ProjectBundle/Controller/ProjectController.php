<?php

namespace WS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use WS\ServiceBundle\Entity\Project;
use WS\ServiceBundle\Form\ProjectType;
use WS\UserBundle\Entity\Media;

class ProjectController extends Controller
{
    //    Retoune User
    public function getUser()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    //    Retourne EntityManager
    public function getEM()
    {
        return $this->getDoctrine()->getManager();
    }

    public function indexAction(Request $request)
    {
        $em = $this->getEM();
        $project = new Project();
        $project->setName($request->query->get('projectName'));
        $project->setFichier(new Media());
        if ($this->getUser() != 'anon.') {
            $project->setUser($this->getUser());
        }
        $form = $this->createForm($this->get('form.project_type'), $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project->getFichier()->setDirectory("fichiers");

            $project->getUrgent() == true ?
                $project->setExpireUrgent(strtotime(new \DateTime . '+2 days')) :
                $project->setExpireUrgent(null);
            $project->getPremium() == true ?
                $project->setExpirePremium(strtotime(new \DateTime . '+5 days')) :
                $project->setExpirePremium(null);

            $em->persist($project);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Dépôt éffectué avec succès!");
            return $this->redirect($this->generateUrl('profile_my_projects_index'));
        }

        return $this->render('WSProjectBundle:Project:index.html.twig', [
//      "user" => $user,
            'form' => $form->createView()
        ]);

    }

    public function allDomainsAction()
    {
        $em = $this->getEM();
        $allDomains = $em->getRepository('WSUserBundle:Domain')->findAllDomain();

        $response = new JsonResponse();
        return $response->setData([
            'response' => $allDomains
        ]);
    }

    public function deleteAction($id)
    {
        $em = $this->getEM();
        $project = $em->getRepository('WSServiceBundle:Project')->find($id);
        $em->remove($project);
        $em->flush();

        $this->get('session')->getFlashBag()->Add('success', "Projet supprimé avec succès");
        return $this->redirect($this->generateUrl('profile_my_projets_index'));
    }

    public function updateAction(Project $project)
    {
        $request = $this->get('request');
        $em = $this->getEM();

        $form = $this->createForm(new ProjectType(), $project);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            $project->getFichier()->setDirectory("fichiers");

            $em->merge($project);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Le projet a été modifié avec succès!");
            return $this->redirect($this->generateUrl('profile_my_projects_index'));
        }

        return $this->render('WSProjectBundle:Project:edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
            'user' => $this->getUser()
        ]);
    }

    public function openOrCloseAction($id, $val)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('WSServiceBundle:Project')->find($id);

        $project->setOpen($val);
        $em->merge($project);
        $em->flush();

        if ($val == 1) {
            $this->get('session')->getFlashBag()->Add('success', "Projet ouvert avec succès");
        } else {
            $this->get('session')->getFlashBag()->Add('success', "Projet fermé avec succès");
        }
        return $this->redirect($this->generateUrl('profile_my_projects_index'));
    }
}
