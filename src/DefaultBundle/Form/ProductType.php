<?php

namespace DefaultBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{

   

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('descriptionFull')
            ->add('code')
            ->add('brand')
            ->add('category')
            ->add('price')
            ->add('priceAction')
            ->add('balanceStock')
            ->add ('icon', FileType::class,['mapped'=>false,'required'=>false])
            ->add('category', EntityType::class, [
                       "class"=>"DefaultBundle:Category",
                        "choice_label"=>"title",
                        "label"=>"категория"         ]);


    }



    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DefaultBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'defaultbundle_product';
    }




}
