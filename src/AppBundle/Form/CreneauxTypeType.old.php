<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreneauxTypeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('duration')->add('debut')->add('fin')->add('monday')->add('tuesday')->add('wednesday')->add('thursday')->add('friday')->add('saturday')->add('sunday')->add('convenance')->add('accessibleClient')->add('debutValidite')->add('finValidite')->add('validiteInfini')->add('createdAt')->add('updatedAt')->add('agenda')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CreneauxType'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_creneauxtype';
    }


}
