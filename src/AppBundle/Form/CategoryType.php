<?php
// src/AppBundle/Form/CategoryType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('color', 'choice', array(
    'choices' => array('r' => 'Red', 'g' => 'Green', 'b' => 'Blue')));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Category'));   	
	}
   
    public function getName()
    {
        return 'category';
    }
}
