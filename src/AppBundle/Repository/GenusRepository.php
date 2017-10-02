<?php
/**
 * Created by PhpStorm.
 * User: anilrayamajhi
 * Date: 3/1/17
 * Time: 10:13 AM
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Genus;

class GenusRepository extends EntityRepository
{
    /**
     * @return Genus[]
     */

    public function findAllPublishedOrderedByRecentlyActive(){
        return $this->createQueryBuilder('genus')
            ->andWhere('genus.isPublished = :isPublished')
            //:isPublished is used as a place holder used to set parameter
            ->setParameter('isPublished', true)
//            ->orderBy('genus.speciesCount', 'DESC')
            ->leftJoin('genus.notes', 'genus_note')
            ->orderBy('genus_note.createdAt', 'DESC')
            ->getQuery()
            ->execute();
    }
}