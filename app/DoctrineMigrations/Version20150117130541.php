<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150117130541 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, gender INT NOT NULL, firstname VARCHAR(255) NOT NULL, secondename VARCHAR(255) NOT NULL, born INT NOT NULL, phone VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, deposit DATETIME NOT NULL, UNIQUE INDEX UNIQ_2DA1797792FC23A8 (username_canonical), UNIQUE INDEX UNIQ_2DA17977A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Avis (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_avis_id INT NOT NULL, emo INT NOT NULL, avis VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, depot DATETIME NOT NULL, INDEX IDX_2FA304CEA76ED395 (user_id), INDEX IDX_2FA304CE41736E95 (user_avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Comment (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, comment VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, depot DATETIME NOT NULL, INDEX IDX_5BC96BF04584665A (product_id), INDEX IDX_5BC96BF0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Demande (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, etat ENUM(\'0\', \'1\', \'2\', \'3\'), nombre INT NOT NULL, ip VARCHAR(255) NOT NULL, depot DATETIME NOT NULL, INDEX IDX_E929EE394584665A (product_id), INDEX IDX_E929EE39A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ImageProfil (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ImageVoiture (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Jours (id INT AUTO_INCREMENT NOT NULL, dim TINYINT(1) NOT NULL, lun TINYINT(1) NOT NULL, mar TINYINT(1) NOT NULL, mer TINYINT(1) NOT NULL, jeu TINYINT(1) NOT NULL, ven TINYINT(1) NOT NULL, sam TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Message (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, message VARCHAR(255) NOT NULL, etat INT NOT NULL, ip VARCHAR(255) NOT NULL, depot DATETIME NOT NULL, userDist_id INT NOT NULL, INDEX IDX_790009E34584665A (product_id), INDEX IDX_790009E3A76ED395 (user_id), INDEX IDX_790009E35D9D9DCE (userDist_id), INDEX my_idx (etat), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Product (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, jours_id INT DEFAULT NULL, updated DATETIME DEFAULT NULL, maj TINYINT(1) NOT NULL, type TINYINT(1) NOT NULL, categorie ENUM(\'0\', \'1\', \'2\') COMMENT \'0:professionnel,1:etudes,2:autre\', filles TINYINT(1) NOT NULL, date DATETIME NOT NULL, heure VARCHAR(255) NOT NULL, depart VARCHAR(255) NOT NULL, villea VARCHAR(255) NOT NULL, arrivee VARCHAR(255) NOT NULL, villeb VARCHAR(255) NOT NULL, place INT NOT NULL, vehicule VARCHAR(255) NOT NULL, prix INT NOT NULL, message VARCHAR(255) NOT NULL, fumer TINYINT(1) NOT NULL, musique TINYINT(1) NOT NULL, animal TINYINT(1) NOT NULL, blabla TINYINT(1) NOT NULL, saa INT NOT NULL, vue INT NOT NULL, valid ENUM(\'0\', \'1\', \'2\', \'3\') COMMENT \'0:refuser,1:valider,2:supprimer,3:En attente\', ip VARCHAR(255) NOT NULL, deposit DATETIME NOT NULL, INDEX IDX_1CF73D31A76ED395 (user_id), UNIQUE INDEX UNIQ_1CF73D316180639B (jours_id), INDEX my_idx (valid, depart, arrivee), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Sortiraalger (id INT AUTO_INCREMENT NOT NULL, lien VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, debut VARCHAR(255) NOT NULL, fin VARCHAR(255) NOT NULL, heure VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, emplacement VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, depot VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Avis ADD CONSTRAINT FK_2FA304CEA76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Avis ADD CONSTRAINT FK_2FA304CE41736E95 FOREIGN KEY (user_avis_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF04584665A FOREIGN KEY (product_id) REFERENCES Product (id)');
        $this->addSql('ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF0A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Demande ADD CONSTRAINT FK_E929EE394584665A FOREIGN KEY (product_id) REFERENCES Product (id)');
        $this->addSql('ALTER TABLE Demande ADD CONSTRAINT FK_E929EE39A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Message ADD CONSTRAINT FK_790009E34584665A FOREIGN KEY (product_id) REFERENCES Product (id)');
        $this->addSql('ALTER TABLE Message ADD CONSTRAINT FK_790009E3A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Message ADD CONSTRAINT FK_790009E35D9D9DCE FOREIGN KEY (userDist_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Product ADD CONSTRAINT FK_1CF73D31A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Product ADD CONSTRAINT FK_1CF73D316180639B FOREIGN KEY (jours_id) REFERENCES Jours (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Avis DROP FOREIGN KEY FK_2FA304CEA76ED395');
        $this->addSql('ALTER TABLE Avis DROP FOREIGN KEY FK_2FA304CE41736E95');
        $this->addSql('ALTER TABLE Comment DROP FOREIGN KEY FK_5BC96BF0A76ED395');
        $this->addSql('ALTER TABLE Demande DROP FOREIGN KEY FK_E929EE39A76ED395');
        $this->addSql('ALTER TABLE Message DROP FOREIGN KEY FK_790009E3A76ED395');
        $this->addSql('ALTER TABLE Message DROP FOREIGN KEY FK_790009E35D9D9DCE');
        $this->addSql('ALTER TABLE Product DROP FOREIGN KEY FK_1CF73D31A76ED395');
        $this->addSql('ALTER TABLE Product DROP FOREIGN KEY FK_1CF73D316180639B');
        $this->addSql('ALTER TABLE Comment DROP FOREIGN KEY FK_5BC96BF04584665A');
        $this->addSql('ALTER TABLE Demande DROP FOREIGN KEY FK_E929EE394584665A');
        $this->addSql('ALTER TABLE Message DROP FOREIGN KEY FK_790009E34584665A');
        $this->addSql('DROP TABLE User');
        $this->addSql('DROP TABLE Avis');
        $this->addSql('DROP TABLE Comment');
        $this->addSql('DROP TABLE Demande');
        $this->addSql('DROP TABLE ImageProfil');
        $this->addSql('DROP TABLE ImageVoiture');
        $this->addSql('DROP TABLE Jours');
        $this->addSql('DROP TABLE Message');
        $this->addSql('DROP TABLE Product');
        $this->addSql('DROP TABLE Sortiraalger');
    }
}
