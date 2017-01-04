<?php

namespace WS\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Intl\Intl;
use WS\ServiceBundle\Entity\FreelancePostuleMission;
use WS\UserBundle\Entity\Domain;
use WS\UserBundle\Entity\Search;
use WS\ServiceBundle\Entity\Mission;

class CoreController extends Controller {

    //    Retourne EntityManager
    public function getEM() {
        return $this->getDoctrine()->getManager();
    }

    // Retourne la liste des pays
    public function getCountries() {
        $locale = $this->getRequest()->getLocale();
        return \Symfony\Component\Locale\Locale::getDisplayCountries($locale);
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

    /**
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function indexAction() {
        $em = $this->getEM();
        $categories = $em->getRepository('WSUserBundle:Category')->findAll();
        $domains = $em->getRepository('WSUserBundle:Domain')->findAll();

        $search = new Search();
        $form = $this->getFormSearch($search);

        return $this->render('WSCoreBundle:Core:index.html.twig', [
            "categories" => $categories,
            "domains" => $domains,
            'form_freelance' => $form->createView(),
            'form_mission' => $form->createView()
        ]);
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

    public function resultMissionAction() {
        $search = new Search();
        $user = $this->getUser();
        ($user == null) ? $idFreelance = 0 : $idFreelance = $user->getId();

        $form = $this->getFormSearch($search);
        $em = $this->getEM();

        $request = $this->getRequest();
        $form->bind($request);

        $missions = $em->getRepository('WSServiceBundle:Mission')
            ->findAllMissionByDomainAndCountry(
                $search->getDomain(),
                $search->getCountry(),
                $idFreelance
            );

        return $this->render('WSCoreBundle:Search:index.html.twig', [
            "searched" => "missions",
            "results" => $missions
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

    // Postuler à une Mission
    public function postuleMissionAction(Mission $mission) {
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

  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function aboutAction() {
    return $this->render('WSCoreBundle:Core:about.html.twig');
  }

  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function contactAction() {
    return $this->render('WSCoreBundle:Core:contact.html.twig');
  }

  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function howtoAction() {
    return $this->render('WSCoreBundle:Core:howto.html.twig');
  }
}
