<?php

namespace App\Controller\Car;

use App\Entity\Car\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetCarController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager
    )
    {}
    public function __invoke( Car $car): JsonResponse
    {
        // я ищу при помощи findOneBy по словарю [ключ-'id': значение-id полученный из api_platform ] и заношу данные
        // по этому id в $cardata
        $cardata = $this->entityManager->getRepository(Car::class)->findOneBy(['id'=>$car->getId()]);

        //dd($cardata);
        // ну и просто вывожу данные из $cardata в формате словаря
        return new JsonResponse(['id'=>$cardata->getId(),
                                'mark'=>$cardata->getMark(),
                                'type'=>$cardata->getType(),
                                'year'=>$cardata->getYear()],
                            Response::HTTP_CREATED);
    }
}