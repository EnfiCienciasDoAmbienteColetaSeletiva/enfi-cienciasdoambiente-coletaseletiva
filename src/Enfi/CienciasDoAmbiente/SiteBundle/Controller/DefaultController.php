<?php

namespace Enfi\CienciasDoAmbiente\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        if ($this->get('session')->get('encontrarPontoDeColeta')) {
            $encontrarPontoDeColeta = $this->get('session')->get('encontrarPontoDeColeta');
            $encontrarPontoDeColeta->tipoDeLixo = $this->getDoctrine()->getManager()->merge($encontrarPontoDeColeta->tipoDeLixo);
        } else {
            $encontrarPontoDeColeta = new \Enfi\CienciasDoAmbiente\SiteBundle\ValidationEntity\EncontrarPontoDeColeta;
            $encontrarPontoDeColeta->distancia_maxima = 5; // Padrão, 5km
        }
        $form = $this->createFormBuilder($encontrarPontoDeColeta)
            ->add('tipoDeLixo', 'entity', array('class' => 'Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Entity\TipoDeLixo', 'property' => 'nome', 'label' => 'Tipo de lixo'))
            ->add('endereco', null, array('label' => 'Endereço ou CEP'))
            ->add('distancia_maxima', 'genemu_jqueryslider', array('label' => 'Raio de busca: ', 'max' => '50'))
            ->add('submit', 'submit', array('label' => 'Encontre pontos de coleta!'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('session')->set('encontrarPontoDeColeta', $encontrarPontoDeColeta);
            return $this->redirect($this->generateUrl('_map'));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/sobre", name="_about")
     * @Template()
     */
    public function aboutAction()
    {
        return array();
    }

    /**
     * @Route("/informativos", name="_informativos")
     * @Template()
     */
    public function informativosAction()
    {
        return array();
    }

    /**
     * @Route("/user", name="_user")
     * @Template()
     */
    public function userAction()
    {
        return array();
    }

    /**
     * @Route("/map", name="_map")
     * @Template()
     */
    public function mapAction()
    {
        $encontrarPontoDeColeta = $this->get('session')->get('encontrarPontoDeColeta');

        if (!$encontrarPontoDeColeta) {
            return $this->redirect($this->generateUrl('_home'));
        }

        return array('encontrarPontoDeColeta' => $encontrarPontoDeColeta);
    }
}
