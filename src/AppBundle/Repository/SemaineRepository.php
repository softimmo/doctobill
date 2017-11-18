<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;
/**
 * SemaineRepository
 *
 */
class SemaineRepository extends EntityRepository
{
    public function getSemaineActivesByCompany($companyId)
    {
        $now = new \DateTime();
 
        $qb = $this->createQueryBuilder('s');
        $qb->join('s.company', 'company')
            ->andWhere($qb->expr()->eq('company.id', ':companyid'))
              ->setParameter('companyid', $companyId)
            ->andWhere('s.dateDebut >:now')
                ->setParameter('now',$now->modify('-7 day'))
            ->addOrderBy('s.dateDebut', 'asc')
//            ->setMaxResults(20);
        ;
        return $qb->getQuery()->getResult();
    }    
    /*
     public function findOneByNumeroEtCompany($companyId,$numero)
    {
        $now = new \DateTime();
 
        $qb = $this->createQueryBuilder('s');
        $qb->join('s.company', 'company')
            ->andWhere($qb->expr()->eq('company.id', ':companyid'))
              ->setParameter('companyid', $companyId)
            ->andWhere($qb->expr()->eq('s.numero', ':numero'))
                ->setParameter('numero',$numero)
        ;
        return $qb->getQuery()->getOneOrNullResult();
    }    
  */  
     public function findOneByNumeroEtAgenda($agendaId,$numero)
    {
        $now = new \DateTime();
 
        $qb = $this->createQueryBuilder('s');
        $qb->join('s.agenda', 'agenda')
            ->andWhere($qb->expr()->eq('agenda.id', ':agendaid'))
              ->setParameter('agendaid', $agendaId)
            ->andWhere($qb->expr()->eq('s.numero', ':numero'))
                ->setParameter('numero',$numero)
        ;
        return $qb->getQuery()->getOneOrNullResult();
    }    

    
    }
