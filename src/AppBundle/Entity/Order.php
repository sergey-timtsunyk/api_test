<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;

/**
 * Order
 */
class Order
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @Groups({"show"})
     *
     * @var float
     */
    private $amount;

    /**
     * @Groups({"show"})
     *
     * @var string
     */
    private $title;

    /**
     * @Groups({"show"})
     *
     * @var \DateTime
     */
    private $datetime;

    /**
     * @Groups({"show"})
     *
     * @var Client
     */
    private $client;

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
     * Set amount
     *
     * @param float $amount
     *
     * @return Order
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Order
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Order
     */
    public function setDatetime(\DateTime $datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime() : \DateTime
    {
        return $this->datetime;
    }

    /**
     * Set client
     *
     * @param Client $client
     *
     * @return Order
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient() : Client
    {
        return $this->client;
    }

    public function prePersistInit()
    {
        $this->datetime = new \DateTime('now');
    }
}

