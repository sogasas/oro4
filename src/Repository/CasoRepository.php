<?php

namespace App\Repository;

/**
 * CasoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CasoRepository extends \Doctrine\ORM\EntityRepository
{
    public function filtroDQLSinSolucionar($intCodigoEmpresaPk)
    {
        $dql = "SELECT e, d FROM App:Caso d JOIN d.clienteRel e WHERE d.codigoClienteFk <> 0";
        if ($intCodigoEmpresaPk <> 0) {
            $dql .= " AND e.codigoClientePk =" . $intCodigoEmpresaPk;
        }

        $dql .= " AND d.estadoSolucionado = false ";
        $dql .= " ORDER BY d.fechaRegistro ASC";

        return $dql;
    }

    public function filtroDQLSolucionados($intCodigoEmpresaPk)
    {
        $dql = "SELECT e, d FROM App:Caso d JOIN d.clienteRel e WHERE d.codigoClienteFk <> 0";
        if ($intCodigoEmpresaPk <> 0) {
            $dql .= " AND e.codigoClientePk =" . $intCodigoEmpresaPk;
        }

        $dql .= " AND d.estadoSolucionado = true ";
        $dql .= " ORDER BY d.fechaRegistro ASC";

        return $dql;
    }


    // API Functions
    public function listarPorEmpresa($intCodigoCliente)
    {

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb2 = $em->createQueryBuilder();
        $qb2->from('App:Tarea', "t")
            ->select("COUNT(t.codigoTareaPk)")
            ->where("t.codigoCasoFk = c.codigoCasoPk");
        $qb->from("App:Caso", "c")
            ->select("c.codigoCasoPk")
            ->addSelect("c.asunto")
            ->addSelect("c.contacto")
            ->addSelect("c.correo")
            ->addSelect("c.descripcion")
            ->addSelect("c.telefono")
            ->addSelect("c.solucion")
            ->addSelect("c.soporte")
            ->addSelect("c.extension")
            ->addSelect("c.estadoAtendido")
            ->addSelect("c.estadoSolucionado")
            ->addSelect("c.estadoSolicitudInformacion")
            ->addSelect("c.solicitudInformacion")
            ->addSelect("c.respuestaSolicitudInformacion")
            ->addSelect("c.fechaRespuestaSolicitudInformacion")
            ->addSelect("c.usuario")
            ->addSelect("c.fechaRegistro")
            ->addSelect("c.fechaGestion")
            ->addSelect("c.fechaSolucion")
            ->addSelect("c.codigoUsuarioAtiendeFk")
            ->addSelect("c.codigoUsuarioSolucionaFk")
            ->addSelect("c.estadoReabierto")
            ->addSelect("c.estadoEscalado")
            ->addSelect("areaRel.nombre")
            ->addSelect("cargoRel.nombre as cargo")
            ->addSelect("categoriaRel.nombre as categoria")
            ->addSelect("clienteRel.nombreComercial as empresa")
            ->addSelect("prioridadRel.nombre as prioridad")
            ->addSelect("prioridadRel.color as prioridadColor")
            ->addSelect("categoriaRel.color as categoriaColor")
            ->addSelect("({$qb2}) as tareasCuenta")
            ->leftJoin("c.areaRel", "areaRel")
            ->leftJoin("c.cargoRel", "cargoRel")
            ->leftJoin("c.categoriaRel", "categoriaRel")
            ->leftJoin("c.clienteRel", "clienteRel")
            ->leftJoin("c.prioridadRel", "prioridadRel");


        if ($intCodigoCliente != 0):
            $qb->where("c.codigoClienteFk =  {$intCodigoCliente}");
        endif;


        return $qb->getQuery()->getResult();
    }

    public function listarPorCaso($intCodigoEmpresa, $intCodigoCaso)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb2 = $em->createQueryBuilder();
        $qb2->from('App:Tarea', "t")
            ->select("COUNT(t.codigoTareaPk)")
            ->where("t.codigoCasoFk = c.codigoCasoPk");
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->from("App:Caso", "c")
            ->select("c.codigoCasoPk")
            ->addSelect("c.asunto")
            ->addSelect("c.contacto")
            ->addSelect("c.correo")
            ->addSelect("c.descripcion")
            ->addSelect("c.telefono")
            ->addSelect("c.solucion")
            ->addSelect("c.soporte")
            ->addSelect("c.extension")
            ->addSelect("c.estadoAtendido")
            ->addSelect("c.estadoSolucionado")
            ->addSelect("c.estadoSolicitudInformacion")
            ->addSelect("c.solicitudInformacion")
            ->addSelect("c.respuestaSolicitudInformacion")
            ->addSelect("c.fechaRespuestaSolicitudInformacion")
            ->addSelect("c.usuario")
            ->addSelect("c.fechaRegistro")
            ->addSelect("c.fechaGestion")
            ->addSelect("c.fechaSolucion")
            ->addSelect("c.codigoUsuarioAtiendeFk")
            ->addSelect("c.codigoUsuarioSolucionaFk")
            ->addSelect("c.estadoReabierto")
            ->addSelect("c.estadoEscalado")
            ->addSelect("areaRel.nombre as area")
            ->addSelect("areaRel.codigoAreaPk as areaPk")
            ->addSelect("({$qb2}) as tareasCuenta")
            ->addSelect("cargoRel.nombre as cargo")
            ->addSelect("cargoRel.codigoCargoPk as cargoPk")
            ->addSelect("categoriaRel.nombre as categoria")
            ->addSelect("categoriaRel.codigoCategoriaCasoPk as categoriaPk")
            ->addSelect("categoriaRel.color as categoriaColor")
            ->addSelect("clienteRel.nombreComercial as empresa")
            ->addSelect("prioridadRel.nombre as prioridad")
            ->addSelect("prioridadRel.codigo_prioridad_pk as prioridadPk")
            ->addSelect("prioridadRel.color as prioridadColor")
            ->leftJoin("c.areaRel", "areaRel")
            ->leftJoin("c.cargoRel", "cargoRel")
            ->leftJoin("c.categoriaRel", "categoriaRel")
            ->leftJoin("c.clienteRel", "clienteRel")
            ->leftJoin("c.prioridadRel", "prioridadRel")
            ->where("c.codigoCasoPk = {$intCodigoCaso}");
        if ($intCodigoEmpresa != 0):
            $qb->andWhere("c.codigoClienteFk = {$intCodigoEmpresa}");
        endif;


        return $qb->getQuery()->getResult();
    }

    public function listarPorEstadoAtendido($intCodigoEmpresa, $boolEstado)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb2 = $em->createQueryBuilder();
        $qb2->from('App:Tarea', "t")
            ->select("COUNT(t.codigoTareaPk)")
            ->where("t.codigoCasoFk = c.codigoCasoPk");

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->from("App:Caso", "c")
            ->select("c.codigoCasoPk")
            ->addSelect("c.asunto")
            ->addSelect("c.contacto")
            ->addSelect("c.correo")
            ->addSelect("c.descripcion")
            ->addSelect("c.telefono")
            ->addSelect("c.solucion")
            ->addSelect("c.soporte")
            ->addSelect("c.estadoReabierto")
            ->addSelect("c.extension")
            ->addSelect("c.estadoAtendido")
            ->addSelect("c.estadoSolucionado")
            ->addSelect("c.estadoSolicitudInformacion")
            ->addSelect("c.solicitudInformacion")
            ->addSelect("c.respuestaSolicitudInformacion")
            ->addSelect("c.fechaRespuestaSolicitudInformacion")
            ->addSelect("c.usuario")
            ->addSelect("c.fechaRegistro")
            ->addSelect("c.fechaGestion")
            ->addSelect("c.fechaSolucion")
            ->addSelect("c.estadoEscalado")
            ->addSelect("c.codigoUsuarioAtiendeFk")
            ->addSelect("c.codigoUsuarioSolucionaFk")
            ->addSelect("({$qb2}) as tareasCuenta")
            ->addSelect("areaRel.nombre")
            ->addSelect("cargoRel.nombre as cargo")
            ->addSelect("categoriaRel.nombre as categoria")
            ->addSelect("categoriaRel.color as categoriaColor")
            ->addSelect("clienteRel.nombreComercial as empresa")
            ->addSelect("prioridadRel.nombre as prioridad")
            ->addSelect("prioridadRel.color as prioridadColor")
            ->leftJoin("c.areaRel", "areaRel")
            ->leftJoin("c.cargoRel", "cargoRel")
            ->leftJoin("c.categoriaRel", "categoriaRel")
            ->leftJoin("c.clienteRel", "clienteRel")
            ->leftJoin("c.prioridadRel", "prioridadRel");
        if ($boolEstado == 0):
            $qb->where("c.estadoAtendido = false");
        else:
            $qb->where("c.estadoAtendido = true");
        endif;
        if ($intCodigoEmpresa != 0):
            $qb->andWhere("c.codigoClienteFk = {$intCodigoEmpresa}");
        endif;


        return $qb->getQuery()->getResult();

    }

    public function listarPorEstadoSolucionado($intCodigoEmpresa, $boolEstado)
    {


        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb2 = $em->createQueryBuilder();
        $qb2->from('App:Tarea', "t")
            ->select("COUNT(t.codigoTareaPk)")
            ->where("t.codigoCasoFk = c.codigoCasoPk");

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->from("App:Caso", "c")
            ->select("c.codigoCasoPk")
            ->addSelect("c.asunto")
            ->addSelect("c.contacto")
            ->addSelect("c.correo")
            ->addSelect("c.descripcion")
            ->addSelect("c.telefono")
            ->addSelect("c.solucion")
            ->addSelect("c.soporte")
            ->addSelect("c.extension")
            ->addSelect("c.estadoEscalado")
            ->addSelect("c.estadoReabierto")
            ->addSelect("c.estadoAtendido")
            ->addSelect("c.estadoSolucionado")
            ->addSelect("c.estadoSolicitudInformacion")
            ->addSelect("c.solicitudInformacion")
            ->addSelect("c.respuestaSolicitudInformacion")
            ->addSelect("c.fechaRespuestaSolicitudInformacion")
            ->addSelect("c.usuario")
            ->addSelect("c.fechaRegistro")
            ->addSelect("c.fechaGestion")
            ->addSelect("c.fechaSolucion")
            ->addSelect("c.codigoUsuarioAtiendeFk")
            ->addSelect("c.codigoUsuarioSolucionaFk")
            ->addSelect("({$qb2}) as tareasCuenta")
            ->addSelect("areaRel.nombre")
            ->addSelect("cargoRel.nombre as cargo")
            ->addSelect("categoriaRel.nombre as categoria")
            ->addSelect("categoriaRel.color as categoriaColor")
            ->addSelect("clienteRel.nombreComercial as empresa")
            ->addSelect("prioridadRel.nombre as prioridad")
            ->addSelect("prioridadRel.color as prioridadColor")
            ->leftJoin("c.areaRel", "areaRel")
            ->leftJoin("c.cargoRel", "cargoRel")
            ->leftJoin("c.categoriaRel", "categoriaRel")
            ->leftJoin("c.clienteRel", "clienteRel")
            ->leftJoin("c.prioridadRel", "prioridadRel");
        if ($boolEstado == 0):
            $qb->where("c.estadoSolucionado = false");
        else:
            $qb->where("c.estadoSolucionado = true");
        endif;
        if ($intCodigoEmpresa != 0):
            $qb->andWhere("c.codigoClienteFk = {$intCodigoEmpresa}");
        endif;

        return $qb->getQuery()->getResult();
    }

    public function listarPorPropiedad($strPropiedad, $value, $strOrder, $intCodigoCliente, $strPropiedadOrdenar)
    {

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb2 = $em->createQueryBuilder();
        $qb2->from('App:Tarea', "t")
            ->select("COUNT(t.codigoTareaPk)")
            ->where("t.codigoCasoFk = c.codigoCasoPk");

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->from("App:Caso", "c")
            ->select("c.codigoCasoPk")
            ->addSelect("c.asunto")
            ->addSelect("c.contacto")
            ->addSelect("c.correo")
            ->addSelect("c.descripcion")
            ->addSelect("c.telefono")
            ->addSelect("c.solucion")
            ->addSelect("c.soporte")
            ->addSelect("c.estadoReabierto")
            ->addSelect("c.extension")
            ->addSelect("c.estadoAtendido")
            ->addSelect("c.estadoSolucionado")
            ->addSelect("c.usuario")
            ->addSelect("c.fechaRegistro")
            ->addSelect("c.fechaGestion")
            ->addSelect("c.fechaSolucion")
            ->addSelect("c.estadoEscalado")
            ->addSelect("c.codigoUsuarioAtiendeFk")
            ->addSelect("c.codigoUsuarioSolucionaFk")
            ->addSelect("({$qb2}) as tareasCuenta")
            ->addSelect("areaRel.nombre")
            ->addSelect("cargoRel.nombre as cargo")
            ->addSelect("categoriaRel.nombre as categoria")
            ->addSelect("categoriaRel.color as categoriaColor")
            ->addSelect("clienteRel.nombreComercial as empresa")
            ->addSelect("prioridadRel.nombre as prioridad")
            ->addSelect("prioridadRel.color as prioridadColor")
            ->leftJoin("c.areaRel", "areaRel")
            ->leftJoin("c.cargoRel", "cargoRel")
            ->leftJoin("c.categoriaRel", "categoriaRel")
            ->leftJoin("c.clienteRel", "clienteRel")
            ->leftJoin("c.prioridadRel", "prioridadRel")
            ->where("c.{$strPropiedad} = {$value}")
            ->andWhere("c.codigoClienteFk = {$intCodigoCliente}");
        if ($strPropiedadOrdenar != ''):
            $qb->orderBy("c.{$strPropiedadOrdenar}", "{$strOrder}");
        else:
            return $qb->getQuery()->getResult();
        endif;

        return $qb->getQuery()->getResult();

    }

    public function borraUnCaso($intCodigoCasoPk)
    {
        //consultamos caso
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->from("App:Caso", "c")
            ->select("c")
            ->Where("c.codigoCasoPk = {$intCodigoCasoPk}");

        //consultamos tareas
        $qb2 = $em->createQueryBuilder();
        $qb2->from('App:Tarea', "t")
            ->select("COUNT(t.codigoTareaPk)")
            ->where("t.codigoCasoFk = {$intCodigoCasoPk}");

        $caso = $qb->getQuery()->getResult();
        $tarea = $qb2->getQuery()->getResult();

        if ($tarea[0]['1'] == 0 && $caso[0]->getEstadoAtendido() == false) {
            $qb3 = $em->createQueryBuilder();
            $qb3->delete("App:Caso", "c")
                ->Where("c.codigoCasoPk = {$intCodigoCasoPk}");
            $qb3->getQuery()->getResult();

            return true;
        } else {
            return false;
        }

    }

    public function apiCaso($codigoCaso)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb2 = $em->createQueryBuilder();
        $qb2->from('App:Tarea', "t")
            ->select("COUNT(t.codigoTareaPk)")
            ->where("t.codigoCasoFk = c.codigoCasoPk");
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->from("App:Caso", "c")
            ->select("c.codigoCasoPk")
            ->addSelect("c.asunto")
            ->addSelect("c.contacto")
            ->addSelect("c.correo")
            ->addSelect("c.descripcion")
            ->addSelect("c.telefono")
            ->addSelect("c.solucion")
            ->addSelect("c.solicitudInformacion")
            ->addSelect("c.respuestaSolicitudInformacion")
            ->addSelect("c.soporte")
            ->addSelect("c.extension")
            ->addSelect("c.estadoAtendido")
            ->addSelect("c.estadoSolucionado")
            ->addSelect("c.estadoRespuestaSolicitudInformacion")
            ->addSelect("c.usuario")
            ->addSelect("c.fechaRegistro")
            ->addSelect("c.fechaGestion")
            ->addSelect("c.fechaSolucion")
            ->addSelect("c.fechaSolicitudInformacion")
            ->addSelect("c.fechaRespuestaSolicitudInformacion")
            ->addSelect("c.codigoUsuarioAtiendeFk")
            ->addSelect("c.codigoUsuarioSolucionaFk")
            ->addSelect("c.estadoReabierto")
            ->addSelect("c.estadoEscalado")
            ->addSelect("areaRel.nombre as area")
            ->addSelect("areaRel.codigoAreaPk as areaPk")
            ->addSelect("({$qb2}) as tareasCuenta")
            ->addSelect("cargoRel.nombre as cargo")
            ->addSelect("cargoRel.codigoCargoPk as cargoPk")
            ->addSelect("categoriaRel.nombre as categoria")
            ->addSelect("categoriaRel.codigoCategoriaCasoPk as categoriaPk")
            ->addSelect("categoriaRel.color as categoriaColor")
            ->addSelect("clienteRel.nombreComercial as empresa")
            ->addSelect("prioridadRel.nombre as prioridad")
            ->addSelect("prioridadRel.codigo_prioridad_pk as prioridadPk")
            ->addSelect("prioridadRel.color as prioridadColor")
            ->leftJoin("c.areaRel", "areaRel")
            ->leftJoin("c.cargoRel", "cargoRel")
            ->leftJoin("c.categoriaRel", "categoriaRel")
            ->leftJoin("c.clienteRel", "clienteRel")
            ->leftJoin("c.prioridadRel", "prioridadRel")
            ->where("c.codigoCasoPk = {$codigoCaso}");
        return $qb->getQuery()->getResult();
    }

}