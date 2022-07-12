<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['collection']],
        ],
        'post' => [
             "controller" => NotFoundAction::class,
             "read" => false,
             "output" => false,
        ]
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['item']],
        ],
        'delete' => [
            "controller" => NotFoundAction::class,
            "read" => false,
            "output" => false,
        ]
    ],
    normalizationContext: ['groups' => ['item', 'collection']]
)]
class Customer
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[Groups(["item", "collection"])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    public string $firstName = '';

    #[ORM\Column(type: 'string', length: 255)]
    public string $lastName = '';

    #[Groups(["item", "collection"])]
    public string $fullName = '';

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Email]
    #[Groups(["item", "collection"])]
    public string $email = '';

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item", "collection"])]
    public string $country = '';

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])]
    public string $username = '';

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])]
    public string $gender = '';

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])]
    public string $city = '';

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["item"])]
    public string $phone = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        $this->fullName = $this->firstName . ' ' . $this->lastName;

        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
