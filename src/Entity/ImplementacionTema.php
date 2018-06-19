<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Caso
 *
 * @ORM\Table(name="implementacion_tema")
 * @ORM\Entity(repositoryClass="App\Repository\ImplementacionTemaRepository")
 */
class ImplementacionTema
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_implementacion_tema_pk", type="integer", unique=true)
     */
    private $codigoImplementacionTemaPk;

    /**
     * @ORM\Column(name="nombre", type="string", length=50, nullable= TRUE)
     */
    private $nombre;

    /**
     *
     * @ORM\OneToMany(targetEntity="ImplementacionDetalle", mappedBy="implementacionTemaRel")
     */
    private $implementacionesDetallesImplementacionTemaRel;

    /**
     * @return int
     */
    public function getCodigoImplementacionTemaPk(): int
    {
        return $this->codigoImplementacionTemaPk;
    }

    /**
     * @param int $codigoImplementacionTemaPk
     */
    public function setCodigoImplementacionTemaPk(int $codigoImplementacionTemaPk): void
    {
        $this->codigoImplementacionTemaPk = $codigoImplementacionTemaPk;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getImplementacionesDetallesImplementacionTemaRel()
    {
        return $this->implementacionesDetallesImplementacionTemaRel;
    }

    /**
     * @param mixed $implementacionesDetallesImplementacionTemaRel
     */
    public function setImplementacionesDetallesImplementacionTemaRel($implementacionesDetallesImplementacionTemaRel): void
    {
        $this->implementacionesDetallesImplementacionTemaRel = $implementacionesDetallesImplementacionTemaRel;
    }

}