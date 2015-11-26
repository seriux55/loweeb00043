<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151122165927 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nroho__User (id INT AUTO_INCREMENT NOT NULL, permis_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, gender INT NOT NULL, firstname VARCHAR(255) NOT NULL, secondename VARCHAR(255) NOT NULL, born INT NOT NULL, phone VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, deposit DATETIME NOT NULL, UNIQUE INDEX UNIQ_2DCDD45392FC23A8 (username_canonical), UNIQUE INDEX UNIQ_2DCDD453A0D96FBF (email_canonical), INDEX IDX_2DCDD4533594A24E (permis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__Avis (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_avis_id INT NOT NULL, emo INT NOT NULL, avis VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, depot DATETIME NOT NULL, INDEX IDX_2FCFA9EAA76ED395 (user_id), INDEX IDX_2FCFA9EA41736E95 (user_avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__BledvoyagePicture (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__Comment (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, comment VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, depot DATETIME NOT NULL, INDEX IDX_3B206A1B4584665A (product_id), INDEX IDX_3B206A1BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__Demande (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, etat ENUM(\'0\', \'1\', \'2\', \'3\'), nombre INT NOT NULL, ip VARCHAR(255) NOT NULL, depot DATETIME NOT NULL, INDEX IDX_89C0EFD24584665A (product_id), INDEX IDX_89C0EFD2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__ImageProfil (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__ImageVoiture (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__Jours (id INT AUTO_INCREMENT NOT NULL, dim TINYINT(1) NOT NULL, lun TINYINT(1) NOT NULL, mar TINYINT(1) NOT NULL, mer TINYINT(1) NOT NULL, jeu TINYINT(1) NOT NULL, ven TINYINT(1) NOT NULL, sam TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__Message (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, message VARCHAR(255) NOT NULL, etat INT NOT NULL, ip VARCHAR(255) NOT NULL, depot DATETIME NOT NULL, userDist_id INT NOT NULL, INDEX IDX_19E908084584665A (product_id), INDEX IDX_19E90808A76ED395 (user_id), INDEX IDX_19E908085D9D9DCE (userDist_id), INDEX my_idx (etat), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__Permis (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, etat ENUM(\'0\', \'1\', \'2\'), ip VARCHAR(255) NOT NULL, date_time DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__Product (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, jours_id INT DEFAULT NULL, updated DATETIME DEFAULT NULL, maj TINYINT(1) NOT NULL, type TINYINT(1) NOT NULL, categorie ENUM(\'0\', \'1\', \'2\') COMMENT \'0:professionnel,1:etudes,2:autre\', filles TINYINT(1) NOT NULL, date DATETIME NOT NULL, heure VARCHAR(255) NOT NULL, depart VARCHAR(255) NOT NULL, villea VARCHAR(255) NOT NULL, arrivee VARCHAR(255) NOT NULL, villeb VARCHAR(255) NOT NULL, place INT NOT NULL, vehicule VARCHAR(255) NOT NULL, prix INT NOT NULL, message VARCHAR(255) DEFAULT NULL, fumer TINYINT(1) NOT NULL, musique TINYINT(1) NOT NULL, animal TINYINT(1) NOT NULL, blabla TINYINT(1) NOT NULL, saa INT NOT NULL, vue INT NOT NULL, valid ENUM(\'0\', \'1\', \'2\', \'3\') COMMENT \'0:refuser,1:valider,2:supprimer,3:En attente\', ip VARCHAR(255) NOT NULL, deposit DATETIME NOT NULL, INDEX IDX_7C1E3CDAA76ED395 (user_id), UNIQUE INDEX UNIQ_7C1E3CDA6180639B (jours_id), INDEX my_idx (valid, depart, arrivee), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__BledvoyageSortie (id INT AUTO_INCREMENT NOT NULL, picture1_id INT DEFAULT NULL, picture2_id INT DEFAULT NULL, picture3_id INT DEFAULT NULL, picture4_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, descriptif VARCHAR(255) NOT NULL, conditions VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, tarif INT NOT NULL, maxPersonne INT NOT NULL, date_debut DATETIME NOT NULL, heure_debut VARCHAR(255) NOT NULL, date_fin DATETIME NOT NULL, heure_fin VARCHAR(255) NOT NULL, video VARCHAR(255) NOT NULL, photo1 VARCHAR(255) NOT NULL, photo2 VARCHAR(255) NOT NULL, photo3 VARCHAR(255) NOT NULL, photo4 VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AE7116A98D5CC633 (picture1_id), UNIQUE INDEX UNIQ_AE7116A99FE969DD (picture2_id), UNIQUE INDEX UNIQ_AE7116A927550EB8 (picture3_id), UNIQUE INDEX UNIQ_AE7116A9BA823601 (picture4_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nroho__Sortiraalger (id INT AUTO_INCREMENT NOT NULL, lien VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, debut VARCHAR(255) NOT NULL, fin VARCHAR(255) NOT NULL, heure VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, emplacement VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, depot VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nroho__User ADD CONSTRAINT FK_2DCDD4533594A24E FOREIGN KEY (permis_id) REFERENCES nroho__Permis (id)');
        $this->addSql('ALTER TABLE nroho__Avis ADD CONSTRAINT FK_2FCFA9EAA76ED395 FOREIGN KEY (user_id) REFERENCES nroho__User (id)');
        $this->addSql('ALTER TABLE nroho__Avis ADD CONSTRAINT FK_2FCFA9EA41736E95 FOREIGN KEY (user_avis_id) REFERENCES nroho__User (id)');
        $this->addSql('ALTER TABLE nroho__Comment ADD CONSTRAINT FK_3B206A1B4584665A FOREIGN KEY (product_id) REFERENCES nroho__Product (id)');
        $this->addSql('ALTER TABLE nroho__Comment ADD CONSTRAINT FK_3B206A1BA76ED395 FOREIGN KEY (user_id) REFERENCES nroho__User (id)');
        $this->addSql('ALTER TABLE nroho__Demande ADD CONSTRAINT FK_89C0EFD24584665A FOREIGN KEY (product_id) REFERENCES nroho__Product (id)');
        $this->addSql('ALTER TABLE nroho__Demande ADD CONSTRAINT FK_89C0EFD2A76ED395 FOREIGN KEY (user_id) REFERENCES nroho__User (id)');
        $this->addSql('ALTER TABLE nroho__Message ADD CONSTRAINT FK_19E908084584665A FOREIGN KEY (product_id) REFERENCES nroho__Product (id)');
        $this->addSql('ALTER TABLE nroho__Message ADD CONSTRAINT FK_19E90808A76ED395 FOREIGN KEY (user_id) REFERENCES nroho__User (id)');
        $this->addSql('ALTER TABLE nroho__Message ADD CONSTRAINT FK_19E908085D9D9DCE FOREIGN KEY (userDist_id) REFERENCES nroho__User (id)');
        $this->addSql('ALTER TABLE nroho__Product ADD CONSTRAINT FK_7C1E3CDAA76ED395 FOREIGN KEY (user_id) REFERENCES nroho__User (id)');
        $this->addSql('ALTER TABLE nroho__Product ADD CONSTRAINT FK_7C1E3CDA6180639B FOREIGN KEY (jours_id) REFERENCES nroho__Jours (id)');
        $this->addSql('ALTER TABLE nroho__BledvoyageSortie ADD CONSTRAINT FK_AE7116A98D5CC633 FOREIGN KEY (picture1_id) REFERENCES nroho__BledvoyagePicture (id)');
        $this->addSql('ALTER TABLE nroho__BledvoyageSortie ADD CONSTRAINT FK_AE7116A99FE969DD FOREIGN KEY (picture2_id) REFERENCES nroho__BledvoyagePicture (id)');
        $this->addSql('ALTER TABLE nroho__BledvoyageSortie ADD CONSTRAINT FK_AE7116A927550EB8 FOREIGN KEY (picture3_id) REFERENCES nroho__BledvoyagePicture (id)');
        $this->addSql('ALTER TABLE nroho__BledvoyageSortie ADD CONSTRAINT FK_AE7116A9BA823601 FOREIGN KEY (picture4_id) REFERENCES nroho__BledvoyagePicture (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nroho__Avis DROP FOREIGN KEY FK_2FCFA9EAA76ED395');
        $this->addSql('ALTER TABLE nroho__Avis DROP FOREIGN KEY FK_2FCFA9EA41736E95');
        $this->addSql('ALTER TABLE nroho__Comment DROP FOREIGN KEY FK_3B206A1BA76ED395');
        $this->addSql('ALTER TABLE nroho__Demande DROP FOREIGN KEY FK_89C0EFD2A76ED395');
        $this->addSql('ALTER TABLE nroho__Message DROP FOREIGN KEY FK_19E90808A76ED395');
        $this->addSql('ALTER TABLE nroho__Message DROP FOREIGN KEY FK_19E908085D9D9DCE');
        $this->addSql('ALTER TABLE nroho__Product DROP FOREIGN KEY FK_7C1E3CDAA76ED395');
        $this->addSql('ALTER TABLE nroho__BledvoyageSortie DROP FOREIGN KEY FK_AE7116A98D5CC633');
        $this->addSql('ALTER TABLE nroho__BledvoyageSortie DROP FOREIGN KEY FK_AE7116A99FE969DD');
        $this->addSql('ALTER TABLE nroho__BledvoyageSortie DROP FOREIGN KEY FK_AE7116A927550EB8');
        $this->addSql('ALTER TABLE nroho__BledvoyageSortie DROP FOREIGN KEY FK_AE7116A9BA823601');
        $this->addSql('ALTER TABLE nroho__Product DROP FOREIGN KEY FK_7C1E3CDA6180639B');
        $this->addSql('ALTER TABLE nroho__User DROP FOREIGN KEY FK_2DCDD4533594A24E');
        $this->addSql('ALTER TABLE nroho__Comment DROP FOREIGN KEY FK_3B206A1B4584665A');
        $this->addSql('ALTER TABLE nroho__Demande DROP FOREIGN KEY FK_89C0EFD24584665A');
        $this->addSql('ALTER TABLE nroho__Message DROP FOREIGN KEY FK_19E908084584665A');
        $this->addSql('DROP TABLE nroho__User');
        $this->addSql('DROP TABLE nroho__Avis');
        $this->addSql('DROP TABLE nroho__BledvoyagePicture');
        $this->addSql('DROP TABLE nroho__Comment');
        $this->addSql('DROP TABLE nroho__Demande');
        $this->addSql('DROP TABLE nroho__ImageProfil');
        $this->addSql('DROP TABLE nroho__ImageVoiture');
        $this->addSql('DROP TABLE nroho__Jours');
        $this->addSql('DROP TABLE nroho__Message');
        $this->addSql('DROP TABLE nroho__Permis');
        $this->addSql('DROP TABLE nroho__Product');
        $this->addSql('DROP TABLE nroho__BledvoyageSortie');
        $this->addSql('DROP TABLE nroho__Sortiraalger');
    }
}
