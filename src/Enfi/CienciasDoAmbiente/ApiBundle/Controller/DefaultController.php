<?php

namespace Enfi\CienciasDoAmbiente\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
        use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/pontos_de_coleta", name="api.pontos_de_coleta")
     */
    public function listPontosDeColetaAction()
    {
        $response = new JsonResponse();
        $json = array();

        // Load pontos de coleta
        $repository = $this->getDoctrine()
            ->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta');
        $pontosDeColeta = $repository->findAll();

        foreach ($pontosDeColeta as $pontoDeColeta) {
            $json[] = array(
                'name' => $pontoDeColeta->getNome(),
                'address' => $pontoDeColeta->getEndereco(),
                'lat' => $pontoDeColeta->getLatitude(),
                'long' => $pontoDeColeta->getLongitude(),
            );
        }

        $response->setData($json);

        return $response;
    }
}
