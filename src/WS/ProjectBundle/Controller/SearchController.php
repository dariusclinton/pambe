<?php

namespace WS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Intl\Intl;
use WS\UserBundle\Entity\Domain;
use WS\UserBundle\Entity\Search;

class SearchController extends Controller {

    //    Retourne EntityManager
    public function getEM() {
        return $this->getDoctrine()->getManager();
    }

    // Formulaire de Recherche Freelance
    public function getFormSearch($search) {
        $formBuilder = $this->get('form.factory')->createBuilder('form', $search);
        $formBuilder
            ->add('domain', 'entity', [
                'class' => 'WSUserBundle:Domain',
                'property' => 'libel',
                'empty_value' => 'Domaines',
                'group_by' => 'category.libelle'
            ])
            ->add('country', null, [
                "required" => true,
                'empty_value' => 'Pays',
                'data' => 'CM'
            ])
        ;
        return $formBuilder->getForm();
    }


    public function resultFreelanceAction() {
        $search = new Search();
        $form = $this->getFormSearch($search);
        $em = $this->getEM();

        $request = $this->getRequest();
        $form->bind($request);

        $freelances = $em->getRepository('WSUserBundle:User')
            ->findAllFreelanceByDomainAndCountry(
                $search->getDomain(),
                $search->getCountry()
             );

        return $this->render('WSCoreBundle:Search:index.html.twig', [
            "searched" => "freelances",
            "results" => $freelances
        ]);
    }

    public function resultProjectAction() {
        $search = new Search();
        $form = $this->getFormSearch($search);
        $em = $this->getEM();

        $request = $this->getRequest();
        $form->bind($request);

        $projects = $em->getRepository('WSServiceBundle:Project')
            ->findAllProjectByDomainAndCountry(
                $search->getDomain(),
                $search->getCountry()
            );

        return $this->render('WSCoreBundle:Search:index.html.twig', [
            "searched" => "projects",
            "results" => $projects
        ]);
    }

    // Find Freelance by Domain
    public function findFreelanceAction(Domain $domain) {
        $em = $this->getEM();
        $freelances = $em->getRepository('WSUserBundle:User')
            ->findAllFreelanceByDomain(
                $domain->getId()
            );

        return $this->render('WSCoreBundle:Core:find_freelance.html.twig', [
            "domain" => $domain,
            "results" => $freelances
        ]);
    }

    // Postuler à une Project
    public function postuleProjectAction(Mission $mission) {
        $em = $this->getEM();
        $user = $this->getUser();
        $freelance_postule_mission = new FreelancePostuleMission();
        $freelance_postule_mission->setFreelancer($user);
        $freelance_postule_mission->setMission($mission);

        $em->persist($freelance_postule_mission);
        $em->flush();

        $this->get('session')
            ->getFlashBag()
            ->Add('success', "Mission : '".$mission->getObject()."'. Postulation effectuée !");

        $response = new JsonResponse();
        return $response->setData([
            "response" => true
        ]);
    }

}
