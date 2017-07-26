<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170724215101 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE `orders` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `client_id` int(11) NOT NULL,
              `amount` decimal(12,2) NOT NULL,
              `title` varchar(25) NOT NULL,
              `datetime` datetime NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `orders_id_uindex` (`id`),
              KEY `orders_clients_id_fk` (`client_id`),
              CONSTRAINT `orders_clients_id_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("DROP TABLE `orders`");
    }
}
