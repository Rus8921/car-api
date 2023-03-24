<?php

namespace App\Entity\Car;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Car\CreationCarController;
use App\Controller\Car\DeleteCarController;
use App\Controller\Car\GetCarController;
use App\Controller\Car\GetCollectionCarController;
use App\Controller\Car\PatchCarController;
use App\Controller\Car\PutCarController;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(operations: [
    new Post(
        uriTemplate: '/car/create',
        controller: CreationCarController :: class,
        name: "CreationCar"
    ),
    new GetCollection(
        uriTemplate: '/car/getcollection',
        controller: GetCollectionCarController :: class,
        name: 'GetCollectionCar'
    ),
    new Delete(
        uriTemplate: '/car/delete/{id}',
        controller: DeleteCarController :: class,
        name:'DeleteCar'
    ),
    new Put(
        uriTemplate: '/car/put/{id}',
        controller: PutCarController :: class,
        name: 'PutCar'
    ),
    new Patch(
        uriTemplate: '/car/patch/{id}',
        controller: PatchCarController :: class,
        name: 'PatchCar'
    ),
    new Get(
        uriTemplate: '/car/get/{id}',
        controller: GetCarController :: class,
        name:'GetCar'
    )
]
)]
#[ORM\Entity]
class Car
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank]
    private ?string $type = null;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank]
    private ?string $mark = null;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank]
    private ?string $year= null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getMark(): ?string
    {
        return $this->mark;
    }

    /**
     * @param string|null $mark
     */
    public function setMark(?string $mark): void
    {
        $this->mark = $mark;
    }

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @param string|null $year
     */
    public function setYear(?string $year): void
    {
        $this->year = $year;
    }


}