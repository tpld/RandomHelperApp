<?php
namespace AppBundle\Controller;

use AppBundle\Form\CategoryType;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /**
     * 
     * @Route("/read/add", name="readAdd")
     */
    public function addAction(Request $request) {
        
    	$read = new Read();
        $form = $this->createForm(new ReadType(), $read);
        
        if ($form->handleRequest($request)->isValid()) {
        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($read);
        	$entityManager->flush();
        	return $this->redirectToRoute('readList');
        }
        return $this->render('AppBundle:Read:add.html.twig', array(
				'form' => $form->createView(),
			));
    }
    
     /**
     * @Route("/read/remove", name="readRemove")
     */
    public function removeAction($id, $confirmed = 0) {
    	$confirmed = (bool)$confirmed;
    	$id = (int)$id;
    	if($confirmed === true)
    	{
    		$em = $this->getDoctrine()->getManager();
    		$read = $this->getDoctrine()->getRepository('AppBundle:Read')->find($id);
    		$em->remove($read);
    		$em->flush();
    		//$this->addFlash('readList', 'Read removed.');
    		//return $this->redirect($this->generateUrl('app.users'));
    		return $this->redirectToRoute('readList');
    	}
    	else
    	{
    		return $this->render('AppBundle:User:remove.html.twig', array(
    			'id' => $id
    		));
    	}
    	
    }
    
    /**
	* @Route("/read/edit", name="readEdit")
	*/
	public function editAction($id, ) {     //DOKOŃCZYĆ!!
	$em = $this->getDoctrine()->getManager();
	$read = $this->getDoctrine()->getRepository('AppBundle:Read')->find($id);
    
    if ($form->handleRequest($request)->isValid()) {

    } 
    
     /**
     * @Route("/read/list", name="readList")
     */
    public function listAction() {
    	$reads = $this->getDoctrine()->getRepository('AppBundle:Read')->findAll();
    	return $this->render('AppBundle:Read:list.html.twig', array(
				'reads' => $reads
			));
    }

}
