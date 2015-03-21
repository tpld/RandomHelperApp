<?php
// src/AppBundle/Form/ReadType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class ReadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('readDate', 'datetime')
            ->add('readVal', 'integer');
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Read'));   	
	}
   
    public function getName()
    {
        return 'read';
    }
}
