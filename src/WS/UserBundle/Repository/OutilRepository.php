<?php

namespace WS\UserBundle\Repository;

/**
 * OutilRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OutilRepository extends \Doctrine\ORM\EntityRepository {

    public function findAllToolByUser($idUser) {

        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT o.id as id, o.libelle as libelle, o.nivExpertise as nex
            FROM WSUserBundle:Outil o
            JOIN o.freelancer f
            WHERE f.id = :idUser
        ')->setParameters( array (
            'idUser' => $idUser
        ));

        return $query->getResult();
    }
}
