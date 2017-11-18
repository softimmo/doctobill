<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class newRdvType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('dateHeureDebut', DateTimeType::class, ['widget' => 'single_text', 'format' => 'H:mm', 'label' => 'Heure',
                    'attr' => ['class' => 'form-control input-inline datepicker', 'data-provide' => 'datepicker',
                        'data-date-format' => 'H:i','placeholder'=>'hh:mm'
                    ]
                ])
                ->add('dateDebut', DateType::class, ['widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'label' => 'Date',
                    'attr' => ['class' => 'form-control input-inline datepicker', 'readonly' => 'readonly', 'data-provide' => 'datepicker',
                        'data-date-format' => 'dd/mm/yyyy','placeholder'=>'dd/mm/yyyy'
                    ]
                ])
                ->add('save', SubmitType::class, array(
                    'label' => 'Valider',
                    'attr' => ['class' => 'form-control btn btn-primary']
                        )
        );
//        $builder->setAction($this->generateUrl('rdv_new')); voir le template pour la moidification de l'action
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Rdv'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'newRdv';
    }

}
