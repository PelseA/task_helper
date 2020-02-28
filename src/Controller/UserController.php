<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @var ObjectRepository
     */
    private $roleRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->roleRepository = $em->getRepository(Role::class);
        $this->em = $em;
    }
    /**
     * @Route("/account/{id}", name="helper.account", methods={"GET", "POST"})
     */
    public function account()
    {
        return $this->render('account.html.twig');
    }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @Route("/register", name="helper.register", methods={"POST"})
     * @return RedirectResponse
     */
    public function registerUser(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $submittedToken = $request->request->get('token');

        if ($this->isCsrfTokenValid('potential-user', $submittedToken)) {
            $data = $this->getNewUserData($request);
            $entityManager = $this->getDoctrine()->getManager();
            $user = new User();
            $password = $encoder->encodePassword($user, $data['password']);
            $user->setName($data['name']);
            $user->setPassword($password);
            $user->setEmail($data['email']);
            $role = $this->roleRepository->findRole('ROLE_USER');
            $user->setRoles($role);

            $entityManager->persist($user);
            $entityManager->flush();
            $id = $user->getId();
            return $this->redirectToRoute('helper.account', array('id' => $id));
           // return new Response('Saved new user with id ' . $user->getId());
        }
    }

        private function getNewUserData($request)
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        return [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
    }

    public function logout()
    {

    }
}