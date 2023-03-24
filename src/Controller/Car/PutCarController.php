<?php

namespace App\Controller\Car;

use App\Entity\Car\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PutCarController extends AbstractController
{

    public function __construct
    (
        private EntityManagerInterface  $entityManager,
    )
    {

    }
    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent());

        // по сути происходит все 1 в 1 из Post, просто я указываю id в api_platform и он перезаписывает данные по этому id
        $car = new Car();
        $car->setType($data->type);
        $car->setMark($data->mark);
        $car->setYear($data->year);

        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return new JsonResponse('Car changed successfully',Response::HTTP_CREATED);
    }
}