<?php
/**
 * Created by PhpStorm.
 * User: avera
 * Date: 4/12/17
 * Time: 11:10 AM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Caso
 *
 * @ORM\Table(name="implementacion_detalle")
 * @ORM\Entity(repositoryClass="App\Repository\ImplementacionDetalleRepository")
 */
class ImplementacionDetalle
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_implementacion_detalle_pk", type="integer", unique=true)
     */
    private $codigoImplementacionDetallePk;

    /**
     * @ORM\Column(name="codigo_implementacion_fk", type="integer", nullable= TRUE)
     */
    private $codigoImplementacionFK;

    /**
     * @ORM\Column(name="codigo_implementacion_grupo_fk", type="integer", nullable=true)
     */
    private $codigoImplementacionGrupoFK;

    /**
     * @ORM\Column(name="codigo_implementacion_tema_fk", type="integer", nullable=true)
     */
    private $codigoImplementacionTemaFK;

    /**
     * @ORM\Column(name="adjunto", type="string", length=255, nullable =true)
     */
    private $adjunto;

    /**
     * @ORM\ManyToOne(targetEntity="Implementacion", inversedBy="implementacionesDetallesImplementacionRel")
     * @ORM\JoinColumn(name="codigo_implementacion_fk", referencedColumnName="codigo_implementacion_pk")
     */
    private $implementacionRel;

    /**
     * @ORM\ManyToOne(targetEntity="ImplementacionGrupo", inversedBy="implementacionesDetallesImplementacionGrupoRel")
     * @ORM\JoinColumn(name="codigo_implementacion_grupo_fk", referencedColumnName="codigo_implementacion_grupo_pk")
     */
    private $implementacionGrupoRel;

    /**
     * @ORM\ManyToOne(targetEntity="ImplementacionTema", inversedBy="implementacionesDetallesImplementacionTemaRel")
     * @ORM\JoinColumn(name="codigo_implementacion_tema_fk", referencedColumnName="codigo_implementacion_tema_pk")
     */
    private $implementacionTemaRel;

    /**
     * @return int
     */
    public function getCodigoImplementacionDetallePk(): int
    {
        return $this->codigoImplementacionDetallePk;
    }

    /**
     * @param int $codigoImplementacionDetallePk
     */
    public function setCodigoImplementacionDetallePk(int $codigoImplementacionDetallePk): void
    {
        $this->codigoImplementacionDetallePk = $codigoImplementacionDetallePk;
    }

    /**
     * @return mixed
     */
    public function getCodigoImplementacionFK()
    {
        return $this->codigoImplementacionFK;
    }

    /**
     * @param mixed $codigoImplementacionFK
     */
    public function setCodigoImplementacionFK($codigoImplementacionFK): void
    {
        $this->codigoImplementacionFK = $codigoImplementacionFK;
    }

    /**
     * @return mixed
     */
    public function getCodigoImplementacionGrupoFK()
    {
        return $this->codigoImplementacionGrupoFK;
    }

    /**
     * @param mixed $codigoImplementacionGrupoFK
     */
    public function setCodigoImplementacionGrupoFK($codigoImplementacionGrupoFK): void
    {
        $this->codigoImplementacionGrupoFK = $codigoImplementacionGrupoFK;
    }

    /**
     * @return mixed
     */
    public function getCodigoImplementacionTemaFK()
    {
        return $this->codigoImplementacionTemaFK;
    }

    /**
     * @param mixed $codigoImplementacionTemaFK
     */
    public function setCodigoImplementacionTemaFK($codigoImplementacionTemaFK): void
    {
        $this->codigoImplementacionTemaFK = $codigoImplementacionTemaFK;
    }

    /**
     * @return mixed
     */
    public function getAdjunto()
    {
        return $this->adjunto;
    }

    /**
     * @param mixed $adjunto
     */
    public function setAdjunto($adjunto): void
    {
        $this->adjunto = $adjunto;
    }

    /**
     * @return mixed
     */
    public function getImplementacionRel()
    {
        return $this->implementacionRel;
    }

    /**
     * @param mixed $implementacionRel
     */
    public function setImplementacionRel($implementacionRel): void
    {
        $this->implementacionRel = $implementacionRel;
    }

    /**
     * @return mixed
     */
    public function getImplementacionGrupoRel()
    {
        return $this->implementacionGrupoRel;
    }

    /**
     * @param mixed $implementacionGrupoRel
     */
    public function setImplementacionGrupoRel($implementacionGrupoRel): void
    {
        $this->implementacionGrupoRel = $implementacionGrupoRel;
    }

    /**
     * @return mixed
     */
    public function getImplementacionTemaRel()
    {
        return $this->implementacionTemaRel;
    }

    /**
     * @param mixed $implementacionTemaRel
     */
    public function setImplementacionTemaRel($implementacionTemaRel): void
    {
        $this->implementacionTemaRel = $implementacionTemaRel;
    }


}