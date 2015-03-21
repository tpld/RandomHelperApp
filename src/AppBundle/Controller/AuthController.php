<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    public function loginAction(Request $request) {
    	/**
    	 * @var $authenticationUtils \Symfony\Component\Security\Http\Authentication\AuthenticationUtils
    	 */
		$authenticationUtils = $this->get('security.authentication_utils');
		
		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
		
		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();
		
		return $this->render('AppBundle:Auth:login.html.twig', array (
				// last username entered by the user
				'last_username' => $lastUsername,
    			'error' => $error,
    		)
    	);
    }
    
    public function checkAction() {
    	//nothing to do here... Thx captain Security!
    }
}