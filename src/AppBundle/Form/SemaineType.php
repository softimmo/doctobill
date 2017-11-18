<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SemaineType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder // ->add('numero')
                 ->add('dateDebut', DateType::class, 
                 ['widget' => 'single_text','format' => 'dd/MM/yyyy','label'=>'Date de debut (Lundi)',
                'attr' => ['class' => 'form-control input-inline datepicker col-sm-2','readonly'=> 'readonly','data-provide' => 'datepicker',
                    'data-date-format' => 'dd/mm/yyyy'
                ]
                ])
;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Semaine'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_semaine';
    }


}
