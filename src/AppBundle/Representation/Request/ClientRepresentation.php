<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 24.07.17
 * Time: 17:55
 */

namespace AppBundle\Representation\Request;

use AppBundle\Representation\RepresentationInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;

class ClientRepresentation implements RepresentationInterface
{
    /**
     * @Type("string")
     *
     * @Assert\Type("string")
     * @Assert\Length(max = 25, maxMessage = "Your name cannot be longer than {{ limit }} characters")
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $name;

    /**
     * @Type("string")
     *
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $email;

    /**
     * @return string
     */
    public function getName(): string
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
}