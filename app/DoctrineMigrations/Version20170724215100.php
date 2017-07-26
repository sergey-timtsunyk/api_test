<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170724215100 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE `clients` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `uudi` varchar(36) NOT NULL,
              `name` varchar(25) NOT NULL,
              `email` varchar(25) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `clients_id_uindex` (`id`),
              UNIQUE KEY `clients_uudi_uindex` (`uudi`),
              UNIQUE KEY `clients_email_uindex` (`email`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;`");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("DROP TABLE `clients`");
    }
}
