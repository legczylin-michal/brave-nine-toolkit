<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildToolsController extends AbstractController
{
    #[Route('/build', name: 'build_tools')]
    public function index(): Response
    {
        return $this->render('build_tools/index.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }

    #[Route('/build/atk', name: 'atk_build')]
    public function atk(): Response
    {
        return $this->render('build_tools/atk_build.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }

    #[Route('/build/hp', name: 'hp_build')]
    public function hp(): Response
    {
        return $this->render('build_tools/hp_build.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }

    #[Route('/build/other', name: 'other_build')]
    public function other(): Response
    {
        return $this->render('build_tools/other_build.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }

    #[Route('/build/saved', name: 'saved_builds')]
    public function saved(): Response
    {
        return $this->render('build_tools/saved_builds.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }
}
