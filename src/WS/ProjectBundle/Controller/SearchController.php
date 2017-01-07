<?php

namespace WS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Intl\Intl;
use WS\UserBundle\Entity\Domain;
use WS\UserBundle\Entity\Search;

class SearchController extends Controller
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

    // Formulaire de Recherche Freelance
    public function getFormSearch($search)
    {
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
            ]);
        return $formBuilder->getForm();
    }


    public function resultFreelanceAction()
    {
        $user = $this->getUser();
        ($user == 'anon.') ? $idUser = 0 : $idUser = $user->getId();
        $request = $this->getRequest();
        $value = $request->query->get('valSearch');
        $em = $this->getEM();

        $freelances = $em->getRepository('WSUserBundle:User')
            ->findAllFreelanceByValue(
                $value,
                $idUser
            );
        return $this->render('WSProjectBundle:Search:index.html.twig', [
            "searched" => "freelances",
            "results" => $freelances
        ]);
    }

    public function resultProjectAction()
    {
        $user = $this->getUser();
        ($user == 'anon.') ? $idUser = 0 : $idUser = $user->getId();
        $request = $this->getRequest();
        $value = $request->query->get('valSearch');
        $em = $this->getEM();

        $projects = $em->getRepository('WSServiceBundle:Project')
            ->findAllProjectByValue(
                $value,
                $idUser
            );
        return $this->render('WSProjectBundle:Search:index.html.twig', [
            "searched" => "projects",
            "results" => $projects
        ]);
    }

    // Find Freelance by Domain
    public function findFreelanceAction(Domain $domain)
    {
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
    public function postuleProjectAction(Mission $mission)
    {
        $em = $this->getEM();
        $user = $this->getUser();
        $freelance_postule_mission = new FreelancePostuleMission();
        $freelance_postule_mission->setFreelancer($user);
        $freelance_postule_mission->setMission($mission);

        $em->persist($freelance_postule_mission);
        $em->flush();

        $this->get('session')
            ->getFlashBag()
            ->Add('success', "Mission : '" . $mission->getObject() . "'. Postulation effectuée !");

        $response = new JsonResponse();
        return $response->setData([
            "response" => true
        ]);
    }

}
