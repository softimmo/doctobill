<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;
/**
 * SfGuardUserRepository
 *
 */
class UserRepository extends EntityRepository implements UserLoaderInterface
{
    
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    public function generateLogin($userName)
    {
        $login=strtolower($userName);
        $trans = array("é" => "e","è" => "e","ê" => "e","â" => "a","à" => "a","ä" => "a","å" => "a","ô" => "o","ö"=>"o","ø"=>"o");
        $login=strtr($login, $trans);
        $login=preg_replace('/[^a-zA-Z0-9_%\[\]\.\(\)%&-]/s', '', $login);
        
        $sfGuard = $this->findOneByusername($login);
        if (!$sfGuard) {
            return $login;
        } else {
            $newLogin=$login;
            $i=1;
            while ($sfGuard) {
                $newLogin=$login.$i;
                $sfGuard = $this->findOneByusername($newLogin);
                $i++;
            }
            return $newLogin;
        }
    }
    public function getActive($companyId)
    {
        // Comme vous le voyez, le délais est redondant ici, l'idéale serait de le rendre configurable via votre bundle
        $delay = new \DateTime();
        $delay->setTimestamp(strtotime('2 minutes ago'));
 
        $qb = $this->createQueryBuilder('u');
        $qb->join('u.affiliate', 'affiliate')
           ->join('affiliate.company', 'company')
//            ->where('u.lastActivity > :delay')
//            ->setParameter('delay', $delay)
            ->andWhere($qb->expr()->eq('company.id', ':companyid'))
              ->setParameter('companyid', $companyId)
            ->andWhere($qb->expr()->neq('affiliate.nom', ':nom'))
                ->setParameter('nom','Support')
            ->addOrderBy('u.lastActivity', 'desc')
            ->setMaxResults(20);
        ;
 
        return $qb->getQuery()->getResult();
    }    
}
