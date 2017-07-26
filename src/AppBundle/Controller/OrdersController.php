<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 24.07.17
 * Time: 20:24
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\Order;
use AppBundle\Persistent\OrderRepository;
use AppBundle\Representation\Request\OrderRepresentation;
use Doctrine\Common\Persistence\ObjectRepository;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource("Clients")
 */
class OrdersController extends FOSRestController
{
    /**
     * @View(serializerGroups={"show"})
     *
     * @ApiDoc(
     *     description="Get info about list orders by client",
     *     headers={
     *          {
     *              "name"="Content-Type",
     *              "required" = "true",
     *              "description"="Type must be [application/json]"
     *          },
     *      },
     *      output={
     *          "class"="AppBundle\Entity\Order",
     *          "groups"={"show"}
     *      },
     *      statusCodes={
     *         200="Returned orders list",
     *         404="Not found client"
     *      }
     * )
     *
     * @param string $clientId
     *
     * @return array
     */
    public function getOrdersListAction(string $clientId) : array
    {
        return $this
            ->getOrderRepository()
            ->findBy(['client' => $this->getClientByClientId($clientId)]);
    }

    /**
     * @ View(serializerGroups={"show"})
     *
     * @ApiDoc(
     *     description="Create a new order",
     *     headers={
     *          {
     *              "name"="Content-Type",
     *              "required" = "true",
     *              "description"="Type must be [application/json]"
     *          },
     *      },
     *      input="AppBundle\Representation\Request\OrderRepresentation",
     *      output={
     *          "class"="AppBundle\Entity\Order",
     *          "groups"={"show"}
     *      },
     *      statusCodes={
     *         201="Returned when created"
     *      }
     * )
     *
     * @param string $clientId
     * @param Request $request
     *
     * @return Order
     */
    public function postOrdersAction(string $clientId, Request $request) : Order
    {
        $orderRepresentation = $this->getOrderRepresentationByRequest($request);

        return $this
            ->getOrderRepository()
            ->createByOrderRepresentation(
                $this->getClientByClientId($clientId),
                $orderRepresentation
            );
    }

    /**
     * @return OrderRepository|ObjectRepository
     */
    public function getOrderRepository() : ObjectRepository
    {
        return $this
            ->getDoctrine()
            ->getRepository(Order::class);
    }

    /**
     * @param Request $request
     *
     * @return OrderRepresentation
     */
    private function getOrderRepresentationByRequest(Request $request) : OrderRepresentation
    {
        return $this
            ->get('app.services_transform_representation.request.order_representation')
            ->createRepresentation($request);
    }

    /**
     * @param string $clientId
     *
     * @return Client
     */
    private function getClientByClientId(string $clientId) : Client
    {
        return $this
            ->getDoctrine()
            ->getRepository(Client::class)
            ->findOneBy(['uudi' => $clientId]);
    }
}