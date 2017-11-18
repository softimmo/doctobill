<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SemainePlageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                // ->add('valider', SubmitType::class, array('label'=> 'Générer la semaine' ))
                 ->add('monday', CheckboxType::class, array('label'=> ' ','required' => false ,'attr' => ['class' => 'form-control']))
                ->add('tuesday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('wednesday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('thursday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('friday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('saturday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('sunday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SemainePlageType'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_semainePlage';
    }


}
