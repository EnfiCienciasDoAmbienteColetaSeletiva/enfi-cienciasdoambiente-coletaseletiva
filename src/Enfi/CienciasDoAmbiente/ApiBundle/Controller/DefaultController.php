<?php

namespace Enfi\CienciasDoAmbiente\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    private function haversineGreatCircleDistance(
      $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    private function distanciaEntreLatLng($p1, $p2) {
        return $this->haversineGreatCircleDistance($p1['lat'], $p1['lng'], $p2['lat'], $p2['lng']);
    }

    /**
     * @Route("/pontos_de_coleta", name="api.pontos_de_coleta")
     */
    public function listPontosDeColetaAction(Request $request)
    {
        $response = new JsonResponse();
        $json = array();

        // Load pontos de coleta
        $repository = $this->getDoctrine()
            ->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta');
        $pontosDeColeta = $repository->findAll();

        // Posição do usuário
        $p1 = array('lat' => $request->query->get('lat'), 'lng' => $request->query->get('lng'));
        $distancia_maxima = $request->query->get('dist_max') * 1000; // em metros

        foreach ($pontosDeColeta as $pontoDeColeta) {
            $p2 = array('lat' => $pontoDeColeta->getLatitude(), 'lng' => $pontoDeColeta->getLongitude());
            $distancia = $this->distanciaEntreLatLng($p1, $p2);
            if ($distancia <= $distancia_maxima) {
                $json[] = array(
                    'nome' => $pontoDeColeta->getNome(),
                    'idFixo' => $pontoDeColeta->getIdFixo(),
                    'informacoesAdicionais' => ($pontoDeColeta->getInformacoesAdicionais()) ? $pontoDeColeta->getInformacoesAdicionais() : 'N/A',
                    'endereco' => $pontoDeColeta->getEndereco(),
                    'telefone' => ($pontoDeColeta->getTelefone()) ? $pontoDeColeta->getTelefone() : 'Indisponível',
                    'horarioDeFuncionamento' => ($pontoDeColeta->getHorarioDeFuncionamento()) ? $pontoDeColeta->getHorarioDeFuncionamento() : 'Indisponível',
                    'lat' => $pontoDeColeta->getLatitude(),
                    'long' => $pontoDeColeta->getLongitude(),
                    'distancia' => $distancia
                );
            }
        }

        $response->setData($json);

        return $response;
    }
}
