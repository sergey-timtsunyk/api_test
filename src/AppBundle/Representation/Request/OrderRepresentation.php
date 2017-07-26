<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 24.07.17
 * Time: 20:34
 */

namespace AppBundle\Representation\Request;


use AppBundle\Representation\RepresentationInterface;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

class OrderRepresentation implements RepresentationInterface
{
    /**
     * @Type("string")
     *
     * @Assert\Type("string")
     * @Assert\Length(max = 25, maxMessage = "Your title cannot be longer than {{ limit }} characters")
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $title;

    /**
     * @Type("float")
     *
     * @Assert\Callback({"AppBundle\Representation\Validator\AmountValidator", "validate"})
     * @Assert\NotBlank()
     *
     * @var float
     */
    private $amount;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }
}