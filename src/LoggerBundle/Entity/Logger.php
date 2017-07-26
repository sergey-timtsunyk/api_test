<?php

namespace LoggerBundle\Entity;


/**
 * Loggers
 */
class Logger
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $route;

    /**
     * @var string
     */
    private $method;

    /**
     * @var \DateTime
     */
    private $datetime;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $header;


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
     * Set ip
     *
     * @param string $ip
     *
     * @return Logger
     */
    public function setIp(string $ip)
    {
        $this->ip = self::formatIp($ip);

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp() : string
    {
        return $this->ip;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return Logger
     */
    public function setRoute(string $route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute() : string
    {
        return $this->route;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return Logger
     */
    public function setMethod(string $method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Logger
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
     * Set body
     *
     * @param string $body
     *
     * @return Logger
     */
    public function setBody(string $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody() : string
    {
        return $this->body;
    }

    /**
     * Set header
     *
     * @param string $header
     *
     * @return Logger
     */
    public function setHeader(string $header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return string
     */
    public function getHeader() : string
    {
        return $this->header;
    }

    /**
     * Set date
     *
     * @return Logger
     */
    public function setDatePrePersist()
    {
        $this->datetime = new \DateTime();

        return $this;
    }

    /**
     * @todo need move
     * @param string $ip
     *
     * @return string
     */
    public static function formatIp(string $ip) : string
    {
        $list = explode( '.', $ip);

        return sprintf("%03d.%03d.%03d.%03d", $list[0], $list[1], $list[2], $list[3]);
    }
}

