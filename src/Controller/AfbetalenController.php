<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AfbetalenController extends AbstractController
{
    /**
     * @Route("/afbetalen", name="afbetalen")
     */
    public function index()
    {
        return $this->render('afbetalen/index.html.twig', [
            'controller_name' => 'AfbetalenController',
        ]);
    }
}
