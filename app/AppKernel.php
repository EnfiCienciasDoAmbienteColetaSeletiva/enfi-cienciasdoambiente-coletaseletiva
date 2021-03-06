<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //Meus Bundles
            new Enfi\CienciasDoAmbiente\SiteBundle\EnfiCienciasDoAmbienteSiteBundle(),
            // Custom bundles
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            new Padam87\SearchBundle\Padam87SearchBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new SimpleThings\EntityAudit\SimpleThingsEntityAuditBundle(),
            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
            new Enfi\CienciasDoAmbiente\CommonEntitiesBundle\EnfiCienciasDoAmbienteCommonEntitiesBundle(),
            new Enfi\CienciasDoAmbiente\ApiBundle\EnfiCienciasDoAmbienteApiBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
