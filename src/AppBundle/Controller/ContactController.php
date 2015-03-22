<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function indexAction()
    {
    	$contacts = $this->getDoctrine()
    		->getManager()
    		->getRepository('AppBundle:Contact')
    		->findByCreatedBy(array(
    			'createdBy' => $this->getUser()
    		));
        return $this->render('AppBundle:Contact:index.html.twig', array(
        	'contacts' => $contacts
        ));
    }
    
    public function addAction(Request $request) {
    	$form = $this->createForm(new ContactType(), new Contact());
    	$form->handleRequest($request);
    	if($form->isValid())
    	{
    		$this->save($form->getData());
    		$this->addFlash('app.contact', 'Contact created.');
    		return $this->redirect($this->generateUrl('app.contacts'));
    	}
    	return $this->render('AppBundle:Contact:add.html.twig', array(
    		'form' => $form->createView()
    	));
    	
    }
    
    public function editAction(Request $request, $id) {
    	$id = (int)$id;
    	$contact = $this->getDoctrine()->getManager()->getRepository('AppBundle:Contact')->find($id);
    	$form = $this->createForm(new ContactType(), $contact);
    	$form->handleRequest($request);
    	if($form->isValid())
    	{
    		$this->save($form->getData());
    		$this->addFlash('app.contact', 'Contact updated.');
    		return $this->redirect($this->generateUrl('app.contacts'));
    	}
    	return $this->render('AppBundle:Contact:edit.html.twig', array(
    		'form' => $form->createView(),
    		'contact' => $contact
    	));
    }
    
    protected function save(Contact $contact) {
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($contact);
    	$em->flush();
    }
    
    
    
    
    
    
    
    
    
    public function removeAction($id, $confirmed = 0) {
    	$confirmed = (bool)$confirmed;
    	$id = (int)$id;
    	if($confirmed === true)
    	{
    		$em = $this->getDoctrine()->getManager();
    		$contact = $this->getDoctrine()->getManager()->getRepository('AppBundle:Contact')->find($id);
    		$em->remove($contact);
    		$em->flush();
    		$this->addFlash('app.contact', 'Contact removed.');
    		return $this->redirect($this->generateUrl('app.users'));
    	}
    	else
    	{
    		return $this->render('AppBundle:Contact:remove.html.twig', array(
    			'id' => $id
    		));
    	}
    	
    }
}