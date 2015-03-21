<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use AppBundle\Entity\AppBundle\Entity;

class UserController extends Controller
{
    public function indexAction()
    {
    	$users = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')->findAll();
        return $this->render('AppBundle:User:index.html.twig', array(
        	'users' => $users
        ));
    }
    
    protected function getForm($id = 0) {
    	$id = (int)$id;
    	if($id !== 0)
    	{
    		$obj = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')->find($id);
    	}
    	else 
    	{
    		$obj = new User();
    	}
    	
    	return $this->createForm(new UserType(), $obj, array(
   			'action' => $this->generateUrl('app.user.edit', array('id' => $id))
    	));
    }
    
    protected function saveUser($user) {
    	$em = $this->getDoctrine()->getEntityManager();
    	if($user->getId() === null)
    	{
    		$em->persist($user);
    	}
    	$em->flush();
    }
    
    public function formAction($id = 0) {
    	$id = (int)$id;
    	$form = $this->getForm($id);
    	
    	if($form->handleRequest($this->get('request'))->isValid())
    	{
    		$user = $form->getData();
    		$this->saveUser($user);
    		$this->addFlash('userList', 'User saved.');
    		return $this->redirect($this->generateUrl('app.users'));
    	}
    	else
    	{
	    	if($id === 0)
	    	{
		    	return $this->render('AppBundle:User:add.html.twig', array(
		    		'form' => $form->createView()	
		    	));
	    	}
	    	else
	    	{
	    		return $this->render('AppBundle:User:edit.html.twig', array(
	    			'form' => $form->createView()
	    		));
	    	}
    	}
    }
    
    public function removeAction($id, $confirmed = 0) {
    	$confirmed = (bool)$confirmed;
    	$id = (int)$id;
    	if($confirmed === true)
    	{
    		$em = $this->getDoctrine()->getManager();
    		$user = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')->find($id);
    		$em->remove($user);
    		$em->flush();
    		$this->addFlash('userList', 'User removed.');
    		return $this->redirect($this->generateUrl('app.users'));
    	}
    	else
    	{
    		return $this->render('AppBundle:User:remove.html.twig', array(
    			'id' => $id
    		));
    	}
    	
    }
}