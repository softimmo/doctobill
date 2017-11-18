<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType; 
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AgendaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle', TextType::class, array('attr' => ['class' => 'form-control  col-sm-2']))
                ->add('duration', NumberType::class, array('label'=> 'Durée','attr' => ['class' => 'form-control col-sm-6']))
                // ->add('statut')
                ->add('monday', CheckboxType::class, array('label'=> ' ','required' => false ,'attr' => ['class' => 'form-control']))
                ->add('tuesday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('wednesday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('thursday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('friday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('saturday', CheckboxType::class, array('label'=> ' ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('sunday', CheckboxType::class, array('label'=> false,'required' => false,'attr' => ['class' => 'form-control']))
/*
                 ->add('monday', CheckboxType::class, array('label'=> 'Lundi ','required' => false ,'attr' => ['class' => 'form-control']))
                ->add('tuesday', CheckboxType::class, array('label'=> ' Mardi','required' => false,'attr' => ['class' => 'form-control']))
                ->add('wednesday', CheckboxType::class, array('label'=> 'Mercredi','required' => false,'attr' => ['class' => 'form-control']))
                ->add('thursday', CheckboxType::class, array('label'=> 'Jeudi ','required' => false,'attr' => ['class' => 'form-control']))
                ->add('friday', CheckboxType::class, array('label'=> ' Vendredi','required' => false,'attr' => ['class' => 'form-control']))
                ->add('saturday', CheckboxType::class, array('label'=> ' Samedi','required' => false,'attr' => ['class' => 'form-control']))
                ->add('sunday', CheckboxType::class, array('label'=> 'Dimanche','required' => false,'attr' => ['class' => 'form-control']))
*/
                ->add('heureDebut', TimeType::class, array('label'=> 'Heure début ','required' => false))
                ->add('heureFin', TimeType::class, array('label'=> 'Heure fin ','required' => false));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Agenda'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_agenda';
    }


}
