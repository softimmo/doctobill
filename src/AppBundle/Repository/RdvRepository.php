<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Semaine;
/**
 * SemaineRepository
 *
 */
class RdvRepository extends EntityRepository
{
    public function findRdv(Semaine $semaine, $dateHeureDebut, $jour)
    {
        $now = new \DateTime();
 
        $qb = $this->createQueryBuilder('rdv');
        $qb->join('rdv.semaine', 'semaine')
            ->andWhere($qb->expr()->eq('semaine.id', ':semaineid'))
              ->setParameter('semaineid', $semaine->getId())
            ->andWhere($qb->expr()->eq('rdv.dateDebut', ':dateDebut'))
                ->setParameter('dateDebut',$jour)
            ->andWhere($qb->expr()->eq('rdv.dateHeureDebut', ':dateHeureDebut'))
                ->setParameter('dateHeureDebut',$dateHeureDebut)
        ;
        return $qb->getQuery()->getOneOrNullResult();
    }    
    
}
