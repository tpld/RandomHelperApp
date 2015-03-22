<?php
namespace AppBundle\Controller;

use AppBundle\Form\ReadCatType;
use AppBundle\Entity\ReadCat;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /**
     * 
     * @Route("/readCat/add", name="readCatAdd")
     */
    public function addAction(Request $request) {
        
    	$readCat = new ReadCat();
        $form = $this->createForm(new ReadCatType(), $readCat);
        
        if ($form->handleRequest($request)->isValid()) {
        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($readCat);
        	$entityManager->flush();
        	return $this->redirectToRoute('readCatList');
        }
        return $this->render('AppBundle:ReadCat:add.html.twig', array(
				'form' => $form->createView(),
			));
    }
    
     /**
     * @Route("/readCat/remove", name="readCatRemove")
     */
    public function removeAction($id, $confirmed = 0) {
    	$confirmed = (bool)$confirmed;
    	$id = (int)$id;
    	if($confirmed === true)
    	{
    		$em = $this->getDoctrine()->getManager(); //em stands for entityManager
    		$readCat = $this->getDoctrine()->getRepository('AppBundle:ReadCat')->find($id);
    		$em->remove($readCat);
    		$em->flush();
    		return $this->redirectToRoute('readCatList');
    	}
    	else
    	{
    		return $this->render('AppBundle:ReadCat:remove.html.twig', array(
    			'id' => $id
    		));
    	}
    	
    }
    
    /**
	* @Route("/readCat/edit", name="readCatEdit")
	*/
	public function editAction($id, Request $request) {
		$em = $this->getDoctrine()->getManager();
		$readCat = $this->getDoctrine()->getRepository('AppBundle:ReadCat')->find($id);
	
		$form = $this->createFormBuilder($readCat)
		    ->add('readName', 'text');
		    ->getForm();
		
		if ($form->handleRequest($request)->isValid()) {
			$em->flush();
			return $this->redirectToRoute('readCatList');
		} 
		return $this->render('AppBundle:ReadCat:edit.html.twig', array(
				'form' => $form->createView(),
			));
    }
    
     /**
     * @Route("/readCat/list", name="readCatList")
     */
    public function listAction() {
    	$readCats = $this->getDoctrine()->getRepository('AppBundle:ReadCat')->findAll();
    	return $this->render('AppBundle:ReadCat:list.html.twig', array(
				'readCats' => $readCats
			));
    }

}
