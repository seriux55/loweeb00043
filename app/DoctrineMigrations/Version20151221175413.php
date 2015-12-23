<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151221175413 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nroho__User ADD membership_id INT DEFAULT NULL, CHANGE agree agree ENUM(\'0\', \'1\')');
        $this->addSql('ALTER TABLE nroho__User ADD CONSTRAINT FK_2DCDD4531FB354CD FOREIGN KEY (membership_id) REFERENCES nroho__Membership (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DCDD4531FB354CD ON nroho__User (membership_id)');
        $this->addSql('ALTER TABLE nroho__Demande CHANGE etat etat ENUM(\'0\', \'1\', \'2\', \'3\')');
        $this->addSql('ALTER TABLE nroho__Permis CHANGE etat etat ENUM(\'0\', \'1\', \'2\')');
        $this->addSql('ALTER TABLE nroho__Product CHANGE categorie categorie ENUM(\'0\', \'1\', \'2\') COMMENT \'0:professionnel,1:etudes,2:autre\', CHANGE valid valid ENUM(\'0\', \'1\', \'2\', \'3\') COMMENT \'0:refuser,1:valider,2:supprimer,3:En attente\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nroho__Demande CHANGE etat etat VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nroho__Permis CHANGE etat etat VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nroho__Product CHANGE categorie categorie VARCHAR(255) DEFAULT NULL COMMENT \'0:professionnel,1:etudes,2:autre\', CHANGE valid valid VARCHAR(255) DEFAULT NULL COMMENT \'0:refuser,1:valider,2:supprimer,3:En attente\'');
        $this->addSql('ALTER TABLE nroho__User DROP FOREIGN KEY FK_2DCDD4531FB354CD');
        $this->addSql('DROP INDEX UNIQ_2DCDD4531FB354CD ON nroho__User');
        $this->addSql('ALTER TABLE nroho__User DROP membership_id, CHANGE agree agree VARCHAR(255) DEFAULT NULL');
    }
}
