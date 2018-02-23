<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class PrioridadApiController extends FOSRestController {

	/**
	 * @Rest\Get("/api/lista/prioridad")
	 */
	public function lista( Request $request) {


		$restresult = $this->getDoctrine()->getRepository('App:Prioridad')->findAll();

		if ($restresult === null) {
			return new View("No hay prioridades", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}


}