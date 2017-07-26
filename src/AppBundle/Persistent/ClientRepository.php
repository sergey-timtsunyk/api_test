<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 24.07.17
 * Time: 18:13
 */

namespace AppBundle\Persistent;

use AppBundle\Entity\Client;
use AppBundle\Representation\Request\ClientRepresentation;
use Doctrine\ORM\EntityRepository;

class ClientRepository extends EntityRepository
{
    /**
     * @param ClientRepresentation $representation
     *
     * @return Client
     */
    public function createByClientRepresentation(ClientRepresentation $representation) : Client
    {
        $client = new Client();
        $client->setName($representation->getName());
        $client->setEmail($representation->getEmail());

        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush($client);

        return $client;
    }
}