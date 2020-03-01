<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="helper.home")
     */
    public function renderHomePage()
    {
        $listImgs = $this->getSlider();
//        $security = $this->container->get('security.authorization_checker');
//        dump($security);
//        exit;
        return $this->render('home.html.twig', [
            'slider' => $listImgs
        ]);
    }

    private function getSlider()
    {
        $filesystem = new Filesystem();
        $path = $this->getParameter('kernel.project_dir') . '/public/slider';

        if ($filesystem->exists($path)) {
            $list = scandir($path);
            return array_splice($list, 2);
        } else {
            return dump(['no list']);
        }

    }

}