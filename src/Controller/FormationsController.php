<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationsController extends AbstractController
{
    #[Route('/formations', name: 'formations')]
    public function index(): Response
    {
        return $this->render('formations/index.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }

    #[Route('/formations/world-bosses', name: 'world_bosses_formations')]
    public function worldBosses(): Response
    {
        return $this->render('formations/world_bosses_formations.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }

    #[Route('/formations/guild-raids', name: 'guild_raids_formations')]
    public function guildRaids(): Response
    {
        return $this->render('formations/guild_raids_formations.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }
}
