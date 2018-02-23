<?php

namespace App\Repository;

/**
 * LlamadaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LlamadaRepository extends \Doctrine\ORM\EntityRepository
{    
    public function getPendientes() {
        $em = $this->getEntityManager();
        $pendientes = 0;
        $dql   = "SELECT COUNT(l.codigoLlamadaPk) AS pendientes FROM App:Llamada l WHERE l.estadoAtendido = 0 AND l.estadoSolucionado = 0";
        $query = $em->createQuery($dql);
        $arrLlamadas = $query->getSingleResult();
        if($arrLlamadas) {
            $pendientes = $arrLlamadas['pendientes'];
        }
        return $pendientes;
    }  
    
    public function getAtendidasPendientes() {
        $em = $this->getEntityManager();
        $atendidasPendientes = 0;
        $dql   = "SELECT COUNT(l.codigoLlamadaPk) AS atendidasPendientes FROM App:Llamada l WHERE l.estadoAtendido = 1 AND l.estadoSolucionado = 0";
        $query = $em->createQuery($dql);
        $arrLlamadas = $query->getSingleResult();
        if($arrLlamadas) {
            $atendidasPendientes = $arrLlamadas['atendidasPendientes'];
        }
        return $atendidasPendientes;
    }


    public function getAtendidasPendientesUsuario($codigoUsuarioAtiende)
    {
        $em = $this->getEntityManager();
        $atendidasPendientesusuario = 0;
        $dql = "SELECT COUNT(l.codigoLlamadaPk) AS atendidasPendientesUsuario FROM App:Llamada l WHERE l.estadoAtendido = 1 AND l.estadoSolucionado = 0 AND l.codigoUsuarioAtiendeFk = '" . $codigoUsuarioAtiende."'";
        $query = $em->createQuery($dql);
        $arrLlamadas = $query->getSingleResult();
        if ($arrLlamadas) {
            $atendidasPendientesUsuario = $arrLlamadas['atendidasPendientesUsuario'];
        }
        return $atendidasPendientesUsuario;
    }

    public function listaDql($codigoClientePk = "")
        {
            $em = $this->getEntityManager();
            $db = $em->createQueryBuilder()->from("App:Llamada", "l")
                ->select("l")
                ->andWhere("l.codigoLlamadaPk <> 0")
                ->orderBy("l.estadoAtendido", "ASC")
                ->addOrderBy("l.estadoSolucionado", "ASC");
            if ($codigoClientePk != "") {
                $db->andWhere("l.codigoClienteFk = {$codigoClientePk}");
            }

            return $db;

        }
}
