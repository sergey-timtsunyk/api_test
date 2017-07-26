<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170724215102 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE `loggers` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `ip` varchar(15) NOT NULL,
              `route` varchar(225) NOT NULL,
              `method` varchar(8) NOT NULL,
              `datetime` datetime NOT NULL,
              `body` text NOT NULL,
              `header` text NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `loggers_id_uindex` (`id`)
              FULLTEXT KEY `header_body_fulltext` (`header`,`body`),
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("DROP TABLE `loggers`");
    }
}
