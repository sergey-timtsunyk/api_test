<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 25.07.17
 * Time: 7:01
 */

namespace LoggerBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use LoggerBundle\Entity\Logger;
use LoggerBundle\Persistent\LoggerRepository;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class LoggerController extends FOSRestController
{

    /**
     * @ApiDoc(
     *     description="Get collection transactions by filter",
     *     headers={
     *          {
     *              "name"="Content-Type",
     *              "required" = "true",
     *              "description"="Type must be [application/json]"
     *          },
     *      },
     *      output="LoggerBundle\Entity\Logger",
     *      statusCodes={
     *         200="Returned when successful, collection this resource"
     *      }
     * )
     *
     * @QueryParam(name="id", requirements="\d+", default="0", description="Id record")
     * @QueryParam(name="route", requirements="\w+", default="", description="Route is string")
     * @QueryParam(name="method",  requirements="\w+", default="", description="HTTP method")
     * @QueryParam(name="ip", requirements="^\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}$", default="", description="ip address")
     * @QueryParam(name="lastDate", requirements="^\d{2}.\d{2}.\d{4}$", default="", description="format=d.m.Y")
     * @QueryParam(name="search", requirements="\S+", default="", description="String for search")
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return array
     */
    public function getRequestAction(ParamFetcher $paramFetcher = null) : array
    {
        return empty($paramFetcher) ? []: $this
            ->getLoggerRepository()
            ->searchByFilter(
                $paramFetcher->get('id'),
                $paramFetcher->get('route'),
                $paramFetcher->get('method'),
                $paramFetcher->get('ip'),
                $paramFetcher->get('lastDate'),
                $paramFetcher->get('search')
            );
    }

    /**
     * @return LoggerRepository
     */
    private function getLoggerRepository() : LoggerRepository
    {
        return $this
            ->getDoctrine()
            ->getRepository(Logger::class);
    }
}