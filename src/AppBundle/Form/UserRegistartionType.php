<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class UserRegistartionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
    		->add('user', new UserType());
    	$user = $builder->get('user');
    	$user->remove('password');
    	$user->add('password', 'repeated', array(
    		'type'=>'password',
    		'first_options'  => array('label' => 'Password'),
    		'second_options' => array('label' => 'Repeat Password'),
    	));
    	
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array('data_class' => 'AppBundle\Auth\Model\UserRegistration'));   	
	}
   
    public function getName()
    {
        return 'userRegistartion';
    }
}
