<?php

namespace Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TipoDeLixoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('descricao', null, array('label' => 'Descrição'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Entity\TipoDeLixo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'enfi_cienciasdoambiente_commonentitiesbundle_tipodelixo';
    }
}
