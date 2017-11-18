<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;
/**
 * AgendaRepository
 *
 */
class AgendaRepository extends EntityRepository
{
       public function getSemainePlageTypes($agenda_id)
    {
        // Comme vous le voyez, le délais est redondant ici, l'idéale serait de le rendre configurable via votre bundle
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('sp'))
        ->from('AppBundle:SemainePlageType', 'sp')
        ->join('sp.agenda','agenda')
            ->addOrderBy('sp.debut', 'desc')                ;

        $qb->andWhere($qb->expr()->eq('agenda.id', ':agenda_id'))
              ->setParameter('agenda_id', $agenda_id)
        ;
 
        return $qb->getQuery()->getResult();
    }
}
