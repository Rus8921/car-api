<?php

namespace App\Controller\Car;

use App\Entity\Car\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CreationCarController extends AbstractController
{

    public function __construct
    (
        private EntityManagerInterface  $entityManager,
    )
    {

    }
    public function __invoke(Request $request): Response
    {
        // сначала я занашу в переменные данные из request
        $data = json_decode($request->getContent());

        // дальше я создаю объект класса  car  и заношу в него данные из переменных
        $car = new Car();
        $car->setType($data->type);
        $car->setMark($data->mark);
        $car->setYear($data->year);

        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return new JsonResponse('Car created successfully',Response::HTTP_CREATED);
    }

}