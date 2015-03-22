<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class TaskType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('content', 'text')
            ->add('dueDate', 'date')
            ->add('done', 'checkbox', array('required' => false))
            ->add('priority', 'choice', ['choices' => [0=>'low', 1=>'medium', 2=>'high']])
//            this is not needed anymore
//             ->add('createdBy', 'entity', ['class'=>'AppBundle:User'])
            ->add('assignee', 'entity', ['class'=>'AppBundle:User', 'property' => 'name'])
            ->add('category', 'entity', ['class'=>'AppBundle:Category', 'property' => 'name', 'query_builder' => function(EntityRepository $er) use ($options) {
		        return $er->createQueryBuilder('c')->where('c.createdBy = '.$options['userId']);
		    }]);
            
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(['data_class' => 'AppBundle\Entity\Task',
         		'userId' => 0
        ]);
    }

    public function getName() {
        return 'task';
    }
}

