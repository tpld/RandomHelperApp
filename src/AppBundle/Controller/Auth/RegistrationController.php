<?php

namespace AppBundle\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UserRegistartionType;
use AppBundle\Form\AppBundle\Form;
use AppBundle\Auth\Model\UserRegistration;

class RegistrationController extends Controller
{
    public function formAction(Request $request) {
    	$form = $this->createForm(new UserRegistartionType(), new UserRegistration());
    	
    	$form->handleRequest($request);
    	if($form->isValid())
    	{
    		$this->get('app.auth.registration')->create($form->getData());
    		$this->addFlash('auth.login', 'Account created.');
    		return $this->redirect($this->generateUrl('app.auth.login'));
    	}
    	
    	return $this->render('AppBundle:Auth/Registration:form.html.twig', array(
    		'form' => $form->createView()
    	));
    }
}