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
    public function __invoke(Request $request,Car $car): Response
    {
        $cardata = $this->entityManager->getRepository(Car::class)->findOneBy(['id'=>$car->getId()]);

        if (isset($cardata->type)) {
            $cardata->setType($cardata->type);
        }

        if (isset($cardata->mark)) {
            $cardata->setMark($cardata->mark);
        }
        if (isset($cardata->year)) {
            $cardata->setYear($cardata->year);
        }

        $this->entityManager->persist($cardata);
        $this->entityManager->flush();

        return new JsonResponse('Car changed successfully',Response::HTTP_CREATED);
    }
}

