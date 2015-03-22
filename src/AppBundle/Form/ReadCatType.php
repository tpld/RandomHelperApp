<?php
// src/AppBundle/Form/ReadCatType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class ReadCatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('readName', 'text');
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array('data_class' => 'AppBundle\Entity\ReadCat'));   	
	}
   
    public function getName()
    {
        return 'readCat';
    }
}
