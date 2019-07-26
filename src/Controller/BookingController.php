<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * BookingController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @Route("/booking", name="booking")
     */
    public function index()
    {
        $hotels= $this->em->getRepository("App\Entity\Hotel")->findAll();
        return $this->render('booking/index.html.twig', [
            "hotels" => $hotels
        ]);
    }
}
