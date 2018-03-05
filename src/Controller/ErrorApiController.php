<?php
/**
 * Created by PhpStorm.
 * User: jako
 * Date: 5/03/18
 * Time: 09:04 AM
 */

namespace App\Controller;


use App\Entity\Error;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class ErrorApiController extends Controller
{

    /**
     * @Rest\Post("/api/error/nuevo")
     */
    public function nuevo(Request $request)
    {
        ob_start();
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $error = new Error();
        $error->setCliente($data['cliente'])
            ->setMensaje($data['mensaje'])
            ->setCodigo($data['codigo'])
            ->setRuta($data['ruta'])
            ->setArchivo($data['archivo'])
            ->setTraza($data['traza'])
            ->setFecha(new \DateTime($data['fecha']))
            ->setUrl($data['url']);
        $em->persist($error);
        $em->flush();
        return $error->getId() != null;
    }

    /**
     * @Rest\Get("/api/error/lista/{pagina}/{cliente}/{fecha}", requirements={"pagina"="\d+"}, defaults={"pagina"=1, "cliente"=null, "fecha"=null})
     */
    public function lista(Request $request, $pagina=null, $cliente=null, $fecha=null)
    {
        $limite = 5;
        $em = $this->getDoctrine()->getManager();
        $arrResultados = $em->getRepository("App:Error")->lista($pagina, $cliente, $fecha, $limite);
        if(!$arrResultados) {
            return new View("No hay errores", Response::HTTP_NOT_FOUND);
        }
        return $arrResultados;
    }

    /**
     * @Rest\Get("/api/error/get/{codigo}", requirements={"codigo"="\d+"})
     * @param Request $request
     * @param $codigo
     */
    public function listaUno(Request $request, $codigo)
    {
        $em = $this->getDoctrine()->getManager();
        $arError = $em->getRepository("App:Error")->listaUno($codigo);
        if(!$arError) {
            return new View("No hay errores", Response::HTTP_NOT_FOUND);
        }
        return $arError;
    }
}
