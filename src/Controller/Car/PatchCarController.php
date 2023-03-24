<?php

namespace App\Controller\Car;

use App\Entity\Car\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PatchCarController extends AbstractController
{

    public function __construct
    (
        private EntityManagerInterface  $entityManager,
    )
    {

    }
    public function __invoke(Request $request): Response
    {

        // действительно забавно что Put  и Patch тут работает схоже, если я не заполню данные, то он их и не изменит
        $data = json_decode($request->getContent());

        $car = new Car();
        $car->setType($data->type);
        $car->setMark($data->mark);
        $car->setYear($data->year);

        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return new JsonResponse('Car changed successfully',Response::HTTP_CREATED);
    }
}