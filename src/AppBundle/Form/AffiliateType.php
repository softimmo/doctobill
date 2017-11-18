<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class AffiliateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomCourt')
                ->add('nom')   
                ->add('email1', EmailType::class ,array(  'label'=>'email 1', 'required'=>true))   
                ->add('email2',EmailType::class,array( 'label'=>'email 2', 'required'=>false,))   
                ->add('horaire')
                ->add('telephone')
                ->add('adresse1')
                ->add('adresse2')
                ->add('codePostal')
                ->add('commune')
                ->add('convention');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Affiliate'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_company';
    }


}
