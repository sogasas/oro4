<?php

namespace App\Repository;

/**
 * TareaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SolicitudRepository extends \Doctrine\ORM\EntityRepository
{


    public function listaDql($estado = "")
    {
        $em = $this->getEntityManager();
        $db = $em->createQueryBuilder()->from("App:Solicitud", "s")->select("s")
            ->orderBy("s.fechaSolicitud", "DESC");
        if ($estado != 2) {
            if ($estado == 0) {
                $db->andWhere("s.estadoAtendido = 0");
            }
            if ($estado == 1) {
                $db->andWhere("s.estadoAtendido = 1");
            }
        }
        return $db;

    }

    public function listarPorEmpresa($intCodigoCliente)
    {
        $em = $this->getEntityManager();
        $db = $em->createQueryBuilder()->from("App:Solicitud", "s")
            ->select("s.codigoSolicitudPk")
            ->addSelect("s.fechaSolicitud")
            ->addSelect("s.fechaEntrega")
            ->addSelect("s.fechaAtencion")
            ->addSelect("s.estadoAtendido")
            ->addSelect("s.estadoCerrado")
            ->addSelect("s.estadoAprobado")
            ->addSelect("s.vrInversion")
            ->addSelect("s.nombre")
            ->addSelect("s.correo")
            ->addSelect("s.extension")
            ->addSelect("s.telefono")
            ->addSelect("s.contacto")
            ->addSelect("s.descripcion")
            ->addSelect("s.solucion")
            ->addSelect("s.horas")
            ->addSelect("s.codigoSolicitudTipoFk")
            ->addSelect("clienteRel.nombreComercial")
            ->addSelect("solicitudTipoRel.nombre AS nombreSolicitudTipo")
            ->join("s.clienteRel", "clienteRel")
            ->join("s.solicitudTipoRel", "solicitudTipoRel")
            ->where("s.codigoClienteFk = {$intCodigoCliente}");
        return $db->getQuery()->getResult();

    }

    public function listarPorSolicitud($intCodigoCliente, $intCodigoSolicitud)
    {
        $em = $this->getEntityManager();
        $db = $em->createQueryBuilder()->from("App:Solicitud", "s")
            ->select("s.codigoSolicitudPk")
            ->addSelect("s.fechaSolicitud")
            ->addSelect("s.fechaEntrega")
            ->addSelect("s.fechaAtencion")
            ->addSelect("s.estadoAtendido")
            ->addSelect("s.estadoCerrado")
            ->addSelect("s.estadoAprobado")
            ->addSelect("s.vrInversion")
            ->addSelect("s.nombre")
            ->addSelect("s.correo")
            ->addSelect("s.extension")
            ->addSelect("s.telefono")
            ->addSelect("s.contacto")
            ->addSelect("s.descripcion")
            ->addSelect("s.solucion")
            ->addSelect("s.horas")
            ->addSelect("s.codigoSolicitudTipoFk")
            ->addSelect("clienteRel.nombreComercial")
            ->addSelect("solicitudTipoRel.nombre AS nombreSolicitudTipo")
            ->join("s.clienteRel", "clienteRel")
            ->join("s.solicitudTipoRel", "solicitudTipoRel")
            ->where("s.codigoClienteFk = {$intCodigoCliente}")
            ->andWhere("s.codigoSolicitudPk = {$intCodigoSolicitud}");
        return $db->getQuery()->getResult();

    }

}
