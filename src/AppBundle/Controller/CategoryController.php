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
     * @Route("/category/add", name="categoryAdd")
     */
    public function addAction(Request $request) {
        
    	$category = new Category();
        $form = $this->createForm(new CategoryType(), $category);
        
        if ($form->handleRequest($request)->isValid()) {
        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($category);
        	$entityManager->flush();
        	return $this->redirectToRoute('categoryList');
        }
        return $this->render('AppBundle:Category:add.html.twig', array(
				'form' => $form->createView(),
			));
    }
    
     /**
     * @Route("/category/list", name="categoryList")
     */
    public function listAction() {
    	$categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
    	return $this->render('AppBundle:Category:list.html.twig', array(
				'categories' => $categories
			));
    }

}
