<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType ;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RdvClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('evenementType',null,array('label'=>'Type','required'=>'required'))  
                ->add('nom',null,array('label'=>'Nom','required'=>'required','attr' =>['placeholder'=>'nom']))  
                ->add('prenom',null,array('label'=>'Prénom','required'=>'required','attr'=>['placeholder'=>'Prénom']))  
                 ->add('dateNaissance', DateType::class, 
                 ['widget' => 'single_text','format' => 'dd/MM/yyyy','label'=>'Date naissance',
                'attr' => ['class' => 'form-control input-inline datepicker',
                    // 'readonly'=> 'readonly',
                    'data-provide' => 'datepicker','placeholder'=>'jj/mm/yyyy',
                    'data-date-format' => 'dd/mm/yyyy'
                ]
                ])                    
                ->add('telephone',null,array('label'=>'Téléphone','required'=>'required','attr'=>['placeholder'=>'Téléphone']))   
                ->add('email',EmailType::class,array('label'=>'Email','required'=>'required','attr'=>['placeholder'=>'Email']))  
                ->add('message',TextareaType::class,array('label'=>'Message','attr'=>['placeholder'=>'Indiquez ici des informations complémentaires','class' => 'tinymce','rows' => '6']))  
               ->add('save', SubmitType::class, array('label'=> 'Prendre rendez-vous','attr' =>  ['class' => 'btn btn-lg btn-success'] ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Rdv'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rdvclient';
    }


}
