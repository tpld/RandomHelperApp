<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;

class DashboardController extends Controller
{
    public function indexAction()
    {
    	if($this->get('security.context')->isGranted('ROLE_USER') === false)
    	{
    		return $this->redirect($this->generateUrl('app.dashboard'));
    	}
        return $this->render('AppBundle:Dashboard:index.html.twig');
    }
    
}