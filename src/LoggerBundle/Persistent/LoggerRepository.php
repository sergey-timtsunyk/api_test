<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 25.07.17
 * Time: 1:16
 */

namespace LoggerBundle\Persistent;


use Doctrine\ORM\EntityRepository;
use LoggerBundle\Entity\Logger;

class LoggerRepository extends EntityRepository
{
    /**
     * @param Logger $logger
     *
     * @return Logger
     */
    public function save(Logger $logger) : Logger
    {
        $this->getEntityManager()->persist($logger);
        $this->getEntityManager()->flush($logger);

        return $logger;
    }


    /**
     * @param $id
     * @param $route
     * @param $method
     * @param $ip
     * @param $lastDate
     * @param $search
     * @return array
     */
    public function searchByFilter(
        int $id = null,
        string $route = null,
        string $method = null,
        string $ip = null,
        $lastDate = null,
        $search = null
    ) : array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('l')
            ->from(Logger::class, 'l');

        empty($id) ?: $qb->andWhere($qb->expr()->eq('l.id', ':id'))->setParameter('id', $id);
        empty($route) ?: $qb->andWhere($qb->expr()->eq('l.route', ':route'))->setParameter('route', $route);
        empty($method) ?: $qb->andWhere($qb->expr()->eq('l.method', ':method'))->setParameter('method', $method);
        empty($ip) ?: $qb->andWhere($qb->expr()->eq('l.ip', ':ip'))->setParameter('ip', Logger::formatIp($ip));
        empty($lastDate) ?: $qb->andWhere($qb->expr()->between('l.datetime', ':from', ':to'))
            ->setParameter(':from', new \DateTime($lastDate.' 00:00:00'))
            ->setParameter(':to', new \DateTime());
        empty($search) ?: $qb->andWhere('MATCH_AGAINST (l.header, l.body, :search)')->setParameter('search', $search);

        $qb->orderBy('l.id', 'ASC');

        return $qb->getQuery()->getArrayResult();
    }

}