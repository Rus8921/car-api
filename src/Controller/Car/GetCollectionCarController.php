<?php

namespace App\Controller\Car;

use App\Entity\Car\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetCollectionCarController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function __invoke(Car $car): JsonResponse
    {
        // вытаскиваю все данные из таблицы и помещаю в cardatas
        $cardatas = $this->entityManager->getRepository(Car::class)->findAll();
        // создаю массив для будующего заполнения данными из таблицы
        $carArray =["items"=>[]];
        // запалняю массив занося все данные каждой строки в удобном формате
        foreach ($cardatas as &$cardata){
            $carArray["items"][] = ["id" => $cardata->getId(),
                "mark" => $cardata->getMark(),
                "type" => $cardata->getType(),
                "year" => $cardata->getYear(),];
        }
        return new JsonResponse($carArray, Response::HTTP_CREATED);
    }
}