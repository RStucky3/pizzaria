<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Orderpizza;
use App\Entity\Pizza;
use App\Repository\OrderPizzaRepository;
use App\Repository\PizzaRepository;
use         Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/categories/{id}")
     */
    public function menu(Category $category): Response
    {

        return $this->render('Pizza/menu.html.twig', [
            "pizzas" => $category->getPizzas()
        ]);
    }

    /**
     * @Route("/categories")
     */
    public function allpizzas(PizzaRepository $pizzaRepository): Response
    {

        return $this->render('Pizza/menu.html.twig', [
            "pizzas" => $pizzaRepository->findAll()
        ]);
    }


    /**
     * @Route("/contact")
     */
    public function contact(): Response
    {
        return $this->render('Pizza/contact.html.twig', [
        ]);


    }

    /**
     * @Route("/orderpizza/{id}",name="app_order")
     */
    public function new(Pizza $pizza, Request $request, OrderPizzaRepository $orderRepository): Response
    {
        $order = new OrderPizza();
        $order->setPizza($pizza);
        $order->setStatus("ordered");

        $form = $this->createFormBuilder($order)
            ->add('fname', TextType::class, ['label' => 'Voornaam'])
            ->add('sname', TextType::class, ['label' => 'Achternaam'])
            ->add('adress', TextType::class, ['label' => 'Address'])
            ->add('city', TextType::class, ['label' => 'City'])
            ->add('zipcode', TextType::class, ['label' => 'PostCode'])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    '20cm' => '20',
                    '30cm' => '30',
                    '40cm' => '40',
                ],
            ])
            ->add('submit', SubmitType::class, ['label' => 'submit'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            $orderRepository->add($order);
            return $this->redirectToRoute("task_succes");
        }


        return $this->renderForm('pizza/order.html.twig', ['form' => $form]);
    }


    /**
     * @Route("/order/succes/",name="task_succes")
     */
    public function succes(): Response
    {
        return $this->render('pizza/task_succes.html.twig');

    }
}

