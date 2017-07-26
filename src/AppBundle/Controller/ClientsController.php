<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 24.07.17
 * Time: 15:00
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Persistent\ClientRepository;
use AppBundle\Representation\Request\ClientRepresentation;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource("Clients")
 */
class ClientsController extends FOSRestController
{
    /**
     * @View(serializerGroups={"show"})
     *
     * @ApiDoc(
     *     description="Get info about client",
     *     headers={
     *          {
     *              "name"="Content-Type",
     *              "required" = "true",
     *              "description"="Type must be [application/json]"
     *          },
     *      },
     *      output={
     *          "class"="AppBundle\Entity\Client",
     *          "groups"={"show"}
     *      },
     *      statusCodes={
     *         200="Returned client",
     *         404="Not found client"
     *      }
     * )
     *
     * @param string $clientId
     *
     * @return Client
     */
    public function getAction(string $clientId) : Client
    {
        return $this
            ->getClientRepository()
            ->findOneBy(['uudi' => $clientId]);
    }

    /**
     * @View(serializerGroups={"show"})
     *
     * @ApiDoc(
     *     description="Create a new client",
     *     headers={
     *          {
     *              "name"="Content-Type",
     *              "required" = "true",
     *              "description"="Type must be [application/json]"
     *          },
     *      },
     *
     *      input="AppBundle\Representation\Request\ClientRepresentation",
     *      output={
     *          "class"="AppBundle\Entity\Client",
     *          "groups"={"show"}
     *      },
     *      statusCodes={
     *         201="Returned when created"
     *      }
     * )
     *
     * @param Request $request
     *
     * @return Client
     */
    public function postAction(Request $request) : Client
    {
        $clientRepresentation = $this->getclientRepresentationByRequest($request);

        return $this
            ->getClientRepository()
            ->createByClientRepresentation($clientRepresentation);
    }

    /**
     * @return ClientRepository
     */
    public function getClientRepository() : ClientRepository
    {
        return $this
            ->getDoctrine()
            ->getRepository(Client::class);
    }

    /**
     * @param Request $request
     *
     * @return ClientRepresentation
     */
    private function getClientRepresentationByRequest(Request $request) : ClientRepresentation
    {
        return $this
            ->get('app.services_transform_representation.request.client_representation')
            ->createRepresentation($request);
    }
}