<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 24.07.17
 * Time: 20:37
 */

namespace AppBundle\Persistent;

use AppBundle\Entity\Client;
use AppBundle\Entity\Order;
use AppBundle\Representation\Request\OrderRepresentation;
use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
    /**
     * @param Client $client
     * @param OrderRepresentation $representation
     *
     * @return Order
     */
    public function createByOrderRepresentation(Client $client, OrderRepresentation $representation)
    {
        $order = new Order();
        $order->setClient($client);
        $order->setTitle($representation->getTitle());
        $order->setAmount($representation->getAmount());

        $this->getEntityManager()->persist($order);
        $this->getEntityManager()->flush($order);

        return $order;
    }
}