<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;
use Ramsey\Uuid\Uuid;

/**
 * Clients
 */
class Client
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @Groups({"show"})
     * @SerializedName("clientId")
     *
     * @var string
     */
    private $uudi;

    /**
     * @Groups({"show"})
     *
     * @var string
     */
    private $name;

    /**
     * @Groups({"show"})
     *
     * @var string
     */
    private $email;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get uudi
     *
     * @return string
     */
    public function getUudi() : string
    {
        return $this->uudi;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Client
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
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
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function prePersistInit()
    {
        $this->uudi = Uuid::uuid4();
    }
}

