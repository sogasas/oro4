<?php

namespace App\Repository;

/**
 * TareaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArchivoRepository extends \Doctrine\ORM\EntityRepository
{
    public function apiListaCaso( $codigoCaso ) {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->from( "App:Tarea", "t" )
            ->select( "t.codigoTareaPk" )
            ->addSelect( "t.descripcion" )
            ->where( "t.codigoCasoFk = {$codigoCaso}" );


        return $qb->getQuery()->getResult();
    }

}
