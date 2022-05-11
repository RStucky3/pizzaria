<?php

namespace App\Controller;

use         Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage(): Response
    {
        $pizza = ["Meat", "Vegan", "Fish"];
        return $this->render('Pizza/home.html.twig', [
            'pizza' => $pizza
        ]);

        
    }

    public function pizza($pizza): Response
    {
        $choice = [
            "Meat" => ['pepperoni'],
            "Vegan" => ['margherita'],
            "Fish" => ['tonno'],
        ];
        return $this->render('Pizza/menu.html.twig', [
            'pizza' => $pizza
        ]);
    }

    /**
     * @Route("/menu")
     */
    public function menu(): Response
    {
        return $this->render('Pizza/menu.html.twig', []);


    }


    /**
     * @Route("/contact")
     */
    public function contact(): Response
    {
        return $this->render('Pizza/contact.html.twig', [
        ]);


    }
}

