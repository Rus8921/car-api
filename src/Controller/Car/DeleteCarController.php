<?php

namespace App\Controller\Car;

use App\Entity\Car\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteCarController extends  AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager
    )
    {}
    public function __invoke( Car $car): JsonResponse
    {
        //  ищу данные по введенному из api_platform id
        $cardata = $this->entityManager->getRepository(Car::class)->findOneBy(['id'=>$car->getId()]);
        //dd($cardata);
        // использую remove чтобы удалить их
        $this-> entityManager -> remove($cardata);
        $this->entityManager->flush();
        //dd($cardata);
        return new JsonResponse('successfully delete car',Response::HTTP_CREATED);
    }
}