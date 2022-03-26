<?php

namespace App\Controller;

use App\Entity\Level;
use App\Repository\LevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/levels", name="app.level.")
 */
class LevelController extends AbstractController
{
    private $levelRepository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->levelRepository = $levelRepository;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $levels = $this->levelRepository->findAll();

        return $this->render('level/index.html.twig', [
            'levels' => $levels,
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     */
    public function show(Level $level): Response
    {
        return $this->render('level/show.html.twig', [
            'level' => $level,
        ]);
    }
}