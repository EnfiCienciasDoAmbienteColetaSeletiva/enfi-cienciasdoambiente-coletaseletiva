<?php

namespace Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PontoDeColetaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('endereco', null, array('label' => 'Endereço'))
            ->add('nome', null, array('label' => 'Nome do local'))
            ->add('telefone')
            ->add('horarioDeFuncionamento', null, array('label' => 'Horário de funcionamento'))
            ->add('latitude')
            ->add('longitude')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Entity\PontoDeColeta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'enfi_cienciasdoambiente_commonentitiesbundle_pontodecoleta';
    }
}
