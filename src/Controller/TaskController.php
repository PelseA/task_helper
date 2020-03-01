<?php

namespace App\Controller;

use App\Entity\TaskTitle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TaskController
 * @package App\Controller
 */
class TaskController extends AbstractController
{
    /**
     * @Route("/task/{id}", methods={"GET"}, name="helper.task")
     */
    public function renderPage()
    {
        $task = $this->getTask();

        return $this->render('task.html.twig', [
            'task' => $task,
        ]);
    }

    public function tasksList()
    {

    }

    /**
     * @Route("/task-create", name="helper.task.create", methods={"POST"})
     * @param Request $request
     * @return RedirectResponse
     */
    public function createTask(Request $request)
    {
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('new-task', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            $newTask = new TaskTitle();
            $title = $request->request->get('title');
           // $data = $this->newTaskData($request);
            $newTask->setTitle($title);
            $newTask->setDateCreate(new \DateTime());
            $newTask->setStatus(false);

            $entityManager->persist($newTask);
            $entityManager->flush();
            $id = $newTask->getId();
            return $this->redirectToRoute('helper.task', array('id' => $id));
        }
    }

    private function getTask()
    {
        return 'Task from getTask';
    }

    private function newTaskData(Request $request)
    {
        $title = $request->request->get('title');

        return [
            'title' => $title
        ];
    }
}