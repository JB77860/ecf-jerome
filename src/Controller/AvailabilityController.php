<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AvailabilityController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * AvailabilityController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @Route("/availability", name="availability")
     */
    public function index()
    {
        $hotels= $this->em->getRepository("App\Entity\Hotel")->findAll();


        return $this->render('booking/index.html.twig', [
            "hotels" => $hotels
        ]);
    }
}
