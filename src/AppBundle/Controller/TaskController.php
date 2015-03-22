<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\TaskType;
use AppBundle\Entity\Task;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class TaskController extends Controller {
    /**
     * @Route("/task/list", name="tasks")
     */
    public function indexAction() {
        // Doctrine
        $allTasks = $this->getDoctrine()
            ->getRepository('AppBundle:Task')
        	->findBy(array('createdBy' => $this->getUser()));
        return $this->render('AppBundle:Task:index.html.twig', array('allTasks' => $allTasks));
    }

    /**
     * @Route("/task/new", name="new_task")
     */
    public function addAction(Request $request) {
        $task = new Task();

        # stwarzamy obiekt formularza
        $form = $this->createForm(new TaskType(), $task);

        # obsłuż żądanie http
        $form->handleRequest($request);

        if ($form->isValid()) {
            # zachowaj zadanie (task) w bazie danych
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            # po przesłaniu poprawnie wypełnionego formularza i zapisaniu czego trzeba do bazy danych,
            # przekierowujemy do listy wszystkich zadań (tasków)
            return $this->redirectToRoute('tasks');
        }

        return $this->render('AppBundle:Task:add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/task/show/{id}", name="show_task")
     * @Template("AppBundle:Task:show.html.twig")
     */
    public function showAction($id) {
        $task = $this->getDoctrine()
            ->getRepository('AppBundle:Task')
            ->find($id);
        return ['task' => $task];
    }

    /**
     * @Route("/task/edit/{id}", name="edit_task")
     */
    public function editAction($id, Request $request) {
        $task = $this->getDoctrine()
            ->getRepository('AppBundle:Task')
            ->find($id);

        # stwarzamy obiekt formularza
        $form = $this->createForm(new TaskType(), $task);

        # obsłuż żądanie http
        $form->handleRequest($request);

        if ($form->isValid()) {
            # zachowaj zadanie (task) w bazie danych
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            # po przesłaniu poprawnie wypełnionego formularza i zapisaniu czego trzeba do bazy danych,
            # przekierowujemy do listy wszystkich zadań (tasków)
            return $this->redirectToRoute('tasks');
        }

        return $this->render('AppBundle:Task:edit.html.twig', ['form' => $form->createView()]);        
    }

    /**
     * @Route("/task/remove/{id}", name="remove_task")
     */
    public function removeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $task = $this->getDoctrine()
            ->getRepository('AppBundle:Task')
            ->find($id);
        $em->remove($task);
        $em->flush();
        return $this->redirectToRoute('tasks');
    }
}