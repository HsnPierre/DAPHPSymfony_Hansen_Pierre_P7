<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
Use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"details","list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"details","list"})
     * @Assert\NotBlank
     * @Assert\Unique
     * @Assert\Email(
     *      message = "This value is not valid."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"details","list"})
     * @Assert\NotBlank
     * @Assert\Unique
     */
    private $username;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="customers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"details"})
     */
    private $client;

    /**
     * @Groups({"details","list"})
     */
    private $uri;

    private $type = 'user';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
}
