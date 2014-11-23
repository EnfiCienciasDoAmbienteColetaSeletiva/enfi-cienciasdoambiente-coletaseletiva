<?php

namespace Enfi\CienciasDoAmbiente\SiteBundle\ValidationEntity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * EncontrarPontoDeColeta
 */
class EncontrarPontoDeColeta
{
    /**
     * @var string
     * @Assert\NotNull()
     *
     */
    public $endereco;

    /**
     * @var integer
     * @Assert\NotNull()
     * @Assert\Regex("~^[0-9]+$~")
     *
     */
    //public $distancia_maxima;

    /**
     * @var integer
     *
     */
    public $tipoDeLixo;
}
