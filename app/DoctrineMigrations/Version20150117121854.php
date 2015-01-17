<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150117121854 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Demande CHANGE etat etat ENUM(\'0\', \'1\', \'2\', \'3\')');
        $this->addSql('ALTER TABLE product CHANGE valid valid ENUM(\'0\', \'1\', \'2\', \'3\') COMMENT \'0:refuser,1:valider,2:supprimer,3:En attente\', CHANGE categorie categorie ENUM(\'0\', \'1\', \'2\') COMMENT \'0:professionnel,1:etudes,2:autre\'');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Demande CHANGE etat etat VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Product CHANGE categorie categorie VARCHAR(255) DEFAULT NULL COMMENT \'0:professionnel,1:etudes,2:autre\', CHANGE valid valid VARCHAR(255) DEFAULT NULL COMMENT \'0:refuser,1:valider,2:supprimer,3:En attente\'');
    }
}
